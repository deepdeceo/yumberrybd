<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerFlatRate extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'order_range',
        'commission',
        'notes',
    ];

    /**
     * Optional: Helper function to get commission based on order amount
     */
    public static function getCommission(float $orderAmount): float
    {
        $commission = 0;

        $record = self::query()
            ->orderBy('id')
            ->get()
            ->first(function ($item) use ($orderAmount) {
                if ($item->order_range === '801+' && $orderAmount >= 801) {
                    return true;
                }

                [$min, $max] = explode('-', $item->order_range);
                return $orderAmount >= (float)$min && $orderAmount <= (float)$max;
            });

        if ($record) {
            $commission = (float)$record->commission;
        }

        return $commission;
    }
}
