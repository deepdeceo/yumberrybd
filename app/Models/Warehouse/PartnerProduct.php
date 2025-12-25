<?php

namespace App\Models\Warehouse;

use App\Models\Business\Categories;
use App\Models\User;
use App\Models\UserManagement\Partner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PartnerProduct extends Model
{
      use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'partner_id',
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'images',
        'discount_amount',
        'discount_type',
        'short_description',
        'long_description',
        'status',
        'is_featured',
        'views',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'images'           => 'array',   // JSON → array
        'status'           => 'boolean',
        'is_featured'      => 'boolean',
        'views'            => 'integer',
        'discount_amount'  => 'decimal:2',
    ];

    /**
     * Auto-generate slug
     */
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    /* =======================
        Relationships
    ======================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /* =======================
        Scopes (Business Logic)
    ======================= */

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /* =======================
        Helpers
    ======================= */

    public function hasDiscount(): bool
    {
        return !is_null($this->discount_amount) && !is_null($this->discount_type);
    }
}
