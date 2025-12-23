<?php

namespace App\Models\UserManagement;

use App\Models\Business\Cities;
use App\Models\Business\Zones;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
     use HasFactory;

    protected $fillable = [
        'type',
        'cities', // foreignId column name input logic
        'zones_id',
        'user_id',
        'branch',
        'total_branch',
        'business_name',
        'business_address',
        'opening_hours',
        'minimum_order',
        'business_number',
        'logo',
        'banner',
        'cuisines',
        'isActive',
        'latitude',
        'longitude',
        'is_open',
        'last_online_at',
        'avg_preparation_time',
        'is_verified',
        'business_address'
    ];

    /**
     * JSON কলামগুলোকে অটোমেটিক Array-তে রূপান্তর করার জন্য casts ব্যবহার করা হয়েছে।
     */
    protected $casts = [
        'opening_hours' => 'array',
        'cuisines' => 'array',
        'isActive' => 'boolean',
        'is_open' => 'boolean',
        'is_verified' => 'boolean',
        'last_online_at' => 'datetime',
        'minimum_order' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Owner (User) এর সাথে রিলেশন
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * City এর সাথে রিলেশন (আপনার মাইগ্রেশনে cities কলাম নাম অনুযায়ী)
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(Cities::class, 'cities');
    }

    /**
     * Zone এর সাথে রিলেশন
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zones::class, 'zones_id');
    }
}
