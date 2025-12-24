<?php

namespace App\Models\Warehouse;

use App\Models\AdminPanel;
use App\Models\Business\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // Mass Assignment theke banchate guarded faka rakha hoyeche
    protected $guarded = [];

    // Multiple images JSON array ke automatic PHP array te convert korbe
    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'cities_id' => 'array',
        'zones_id' => 'array',
    ];

    /**
     * Boot function to automatically generate slug from title
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title) . '-' . time();
            }
        });
    }

    /**
     * Relationships
     */

    // Category-r sathe somporko
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }



    /**
     * Helper Methods
     */

    // Discounted Price calculate korar helper
    public function getFinalPriceAttribute()
    {
        if (!$this->discount_amount) {
            return $this->selling_price;
        }

        if ($this->discount_type === 'percent') {
            return $this->selling_price - ($this->selling_price * ($this->discount_amount / 100));
        }

        return $this->selling_price - $this->discount_amount;
    }

    public function user()
    {
        return $this->belongsTo(AdminPanel::class);
    }
}
