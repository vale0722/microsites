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
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}
