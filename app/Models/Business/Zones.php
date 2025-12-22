<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
     use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'location', // polygon coordinates
        'is_active',
    ];

    protected $casts = [
        'location' => 'array', // Automatically cast JSON to array
        'is_active' => 'boolean',
    ];

    // Relationship: Zone belongs to City
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
}
