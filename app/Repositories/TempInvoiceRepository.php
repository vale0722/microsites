<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TempInvoiceRepository
{
    public string $table = 'temp_invoices';

    public function createTemporaryTable(): bool
    {
        return DB::unprepared(file_get_contents(database_path('scripts/create_temp_invoice_table.sql')));
    }

    public function insert(array $rows): bool
    {
        return DB::table($this->table)->insert($rows);
    }

    public function count(): int
    {
        return DB::table($this->table)->count();
    }

    public function all(): Collection
    {
        return DB::table($this->table)->get();
    }

    public function findDuplicateReferences(): Collection
    {
        return DB::table($this->table)
            ->select(['reference', 'line'])
            ->whereExists(function ($query) {
                return $query->select('reference')
                    ->from('invoices')
                    ->whereColumn('invoices.reference', "{$this->table}.reference");
            })
            ->get();
    }

    public function updateInvoices(int $importId): bool
    {
        $columns = [
            'reference',
            'amount',
            'currency',
            'customer_name',
            'dni',
            'description',
            'expired_at',
            'created_at',
            'import_id',
        ];

        $query = DB::table($this->table)
            ->select($columns)
            ->where('import_id', $importId);

        return DB::table('invoices')->insertUsing($columns, $query);
    }
}
