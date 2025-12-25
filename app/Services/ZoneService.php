<?php

namespace App\Services;

use App\Models\Business\Zones;

class ZoneService
{
    /**
     * Detect which zone a given latitude and longitude falls into
     *
     * @param float $lat
     * @param float $lng
     * @return int|null
     */
    public static function detectZone(float $lat, float $lng): ?int
    {
        $zones = Zones::where('is_active', true)->get();

        foreach ($zones as $zone) {
            $polygon = $zone->location['coordinates'][0]; // main ring

            if (self::pointInPolygon([$lng, $lat], $polygon)) {
                return $zone->id;
            }
        }

        return null;
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     *
     * @param float $lat1
     * @param float $lng1
     * @param float $lat2
     * @param float $lng2
     * @return float Distance in kilometers
     */
    public static function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Check if a point is inside a polygon using ray casting algorithm
     *
     * @param array $point [lng, lat]
     * @param array $polygon Array of [lng, lat] coordinates
     * @return bool
     */
    protected static function pointInPolygon(array $point, array $polygon): bool
    {
        [$x, $y] = $point;
        $inside = false;
        $count = count($polygon);

        for ($i = 0, $j = $count - 1; $i < $count; $j = $i++) {
            [$xi, $yi] = $polygon[$i];
            [$xj, $yj] = $polygon[$j];

            $intersect = (($yi > $y) !== ($yj > $y))
                && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);

            if ($intersect) {
                $inside = !$inside;
            }
        }

        return $inside;
    }

}
