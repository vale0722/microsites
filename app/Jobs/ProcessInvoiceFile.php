<?php

namespace App\Jobs;

use App\Constants\ImportStatus;
use App\Models\Import;
use App\Repositories\TempInvoiceRepository;
use App\Services\CsvReader;
use App\Validators\InvoiceValidator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Throwable;

class ProcessInvoiceFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $line;

    private array $rows;

    private array $errors;

    private array $headers;

    private InvoiceValidator $validator;

    private TempInvoiceRepository $repository;

    public function __construct(
        protected Import $import
    ) {
        $this->line = 0;
        $this->rows = [];
        $this->errors = [];
        $this->headers = [];
        $this->validator = new InvoiceValidator();
        $this->repository = new TempInvoiceRepository();
    }

    public function handle(): void
    {
        try {
            $this->repository->createTemporaryTable();

            $reader = new CsvReader($this->import->getFullPath());

            foreach ($reader->rows() as $row) {
                $this->line++;

                if ($this->line === 1) {
                    $this->headers = $row;

                    $this->headers[] = 'line';
                    $this->headers[] = 'import_id';
                } else {
                    $row[] = $this->line;
                    $row[] = $this->import->id;

                    $row = array_combine($this->headers, $row);

                    $this->validate($row);

                    if ($this->hasErrors()) {
                        $this->setImportErrors();

                        break;
                    }

                    $this->rows[] = $row;

                    if ($this->canInsert()) {
                        $this->insert();
                    }
                }
            }

            if ($this->hasRows()) {
                $this->insert();
            }

            if ($this->hasDuplicateReferences()) {
                $this->setImportErrors();

                return;
            }

            if ($this->isSuccessful()) {
                $this->repository->updateInvoices($this->import->id);

                $this->import->status = ImportStatus::COMPLETED;
                $this->import->save();
            }
        } catch (Throwable $th) {
            report($th);

            $this->failed($th);
        }
    }

    public function failed(?Throwable $exception = null): void
    {
        if ($exception) {
            $this->import->errors = Arr::wrap($exception->getMessage());
            $this->import->status = ImportStatus::FAILED;
            $this->import->save();
        }
    }

    private function validate(array $row): void
    {
        $this->validator->validate($row, $this->line);

        if ($this->validator->fails()) {
            $this->errors = $this->validator->getErrors();
        }
    }

    private function canInsert(): bool
    {
        return count($this->rows) == 150;
    }

    private function hasRows(): bool
    {
        return ! empty($this->rows) && $this->isSuccessful();
    }

    private function hasErrors(): bool
    {
        return ! $this->isSuccessful();
    }

    private function isSuccessful(): bool
    {
        return empty($this->errors);
    }

    private function insert(): void
    {
        $this->repository->insert($this->rows);

        $this->rows = [];
    }

    private function hasDuplicateReferences(): bool
    {
        $duplicates = $this->repository->findDuplicateReferences();

        foreach ($duplicates as $duplicate) {
            $this->errors[] = "Line #{$duplicate->line}, error: Duplicate reference {$duplicate->reference}";
        }

        return $duplicates->isNotEmpty();
    }

    private function setImportErrors(): void
    {
        $this->import->errors = $this->errors;
        $this->import->status = ImportStatus::FAILED;
        $this->import->save();
    }
}
