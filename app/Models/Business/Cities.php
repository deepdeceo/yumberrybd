<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'country',
        'location',
        'is_active',
    ];

    protected $casts = [
        'location' => 'array', // Automatically cast JSON to array
    ];
}
