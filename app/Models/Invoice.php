<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
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

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expired_at' => 'date',
            'created_at' => 'date',
        ];
    }
}
