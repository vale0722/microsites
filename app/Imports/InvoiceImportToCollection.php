<?php

namespace App\Imports;

use App\Constants\Currency;
use App\Constants\ImportStatus;
use App\Models\Import;
use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

class InvoiceImportToCollection implements ShouldQueue, ToCollection, WithChunkReading, WithEvents, WithHeadingRow, WithValidation
{
    public function __construct(
        protected Import $import
    ) {
    }

    public function collection(Collection $collection)
    {
        $collection->chunk(250)
            ->each(function (Collection $chunk) {
                $chunk->transform(function (Collection $row): Collection {
                    $row->offsetSet('import_id', $this->import->id);

                    return $row;
                });

                Invoice::insert($chunk->toArray());
            });
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            'reference' => ['required', 'string', 'max:40', 'unique:invoices,reference'],
            'amount' => ['required', 'numeric'],
            'currency' => ['required', Rule::in(Currency::toArray())],
            'customer_name' => ['required', 'string', 'max:100'],
            'dni' => ['required', 'alpha_num', 'max:40'],
            'description' => ['required', 'string', 'max:512'],
            'expired_at' => ['required', 'date'],
            'created_at' => ['required', 'date'],
        ];
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $exception = $event->getException();

                if ($exception instanceof ValidationException) {
                    $this->import->errors = array_map(
                        fn (Failure $failure) => $failure->toArray()[0],
                        $exception->failures()
                    );
                } else {
                    $this->import->errors = Arr::wrap($event->getException()->getMessage());
                }

                $this->import->status = ImportStatus::FAILED;
                $this->import->save();

                Storage::disk(Import::DISK)->delete($this->import->path);

                Invoice::whereBelongsTo($this->import)->delete();
            },
            AfterImport::class => function () {
                $this->import->status = ImportStatus::COMPLETED;
                $this->import->save();

                Storage::disk(Import::DISK)->delete($this->import->path);
            },
        ];
    }
}
