<?php

namespace App\Models;

use App\Constants\CategoryName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $casts = [
        'name' => CategoryName::class,
    ];
}
