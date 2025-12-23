<?php

namespace App\Models\Wallet;

use App\Models\User;
use App\Models\UserManagement\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerPaymentMethod extends Model
{
    protected $table = 'partner_payment_methods';

    /**
     * Enum-like constants (DO NOT hardcode strings elsewhere)
     */
    public const TIME_WEEKLY = 'weekly';
    public const TIME_DAY = 'day';

    public const METHOD_BKASH = 'bkash';
    public const METHOD_BANK = 'bank';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'partner_id',
        'user_id',
        'time_type',
        'payment_method',
        'pay_details',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'pay_details' => 'array',
    ];

    /**
     * Relationships
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helpers (optional but powerful)
     */
    public function isBkash(): bool
    {
        return $this->payment_method === self::METHOD_BKASH;
    }

    public function isBank(): bool
    {
        return $this->payment_method === self::METHOD_BANK;
    }

    public function isWeekly(): bool
    {
        return $this->time_type === self::TIME_WEEKLY;
    }

    public function isDaily(): bool
    {
        return $this->time_type === self::TIME_DAY;
    }
}
