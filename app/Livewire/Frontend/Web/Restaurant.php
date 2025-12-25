<?php

namespace App\Livewire\Frontend\Web;

use App\Models\Business\Zones;
use App\Models\UserManagement\Partner;
use App\Services\ZoneService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]

class Restaurant extends Component
{
    public float $lat;
    public float $lng;
    public ?int $zoneId = null;
    public $restaurants = [];
    public $debugInfo = [];
    public $zoneName = null;

    public function mount($lat = null, $lng = null)
    {
        // Use dummy coordinates if not provided
        $this->lat = $lat ?: 24.3846; // Dummy lat within the polygon
        $this->lng = $lng ?: 88.6272; // Dummy lng within the polygon

        $this->zoneId = ZoneService::detectZone($this->lat, $this->lng);

        // Get zone name if zone is detected
        if ($this->zoneId) {
            $zone = Zones::find($this->zoneId);
            $this->zoneName = $zone ? $zone->name : null;
        }

        // Debug info
        $this->debugInfo = [
            'coordinates' => ['lat' => $this->lat, 'lng' => $this->lng],
            'zoneId' => $this->zoneId,
            'zoneName' => $this->zoneName,
            'total_partners' => Partner::count(),
            'active_partners' => Partner::where('isActive', true)->count(),
            'partners_in_zone' => $this->zoneId ? Partner::where('zones_id', $this->zoneId)->count() : 0,
            'active_partners_in_zone' => $this->zoneId ? Partner::where('zones_id', $this->zoneId)->where('isActive', true)->count() : 0,
        ];

        $this->loadRestaurants();
    }



    protected function loadRestaurants()
    {
        if ($this->zoneId) {
            // Get all active partners in the detected zone
            $this->restaurants = Partner::where('zones_id', $this->zoneId)
                ->where('isActive', true)
                ->get();
        } else {
            // If no zone detected, find nearby partners within 10km radius
            $this->restaurants = $this->findNearbyRestaurants($this->lat, $this->lng, 10); // 10km radius
        }
    }

    protected function findNearbyRestaurants($lat, $lng, $radiusKm = 10)
    {
        // Haversine formula to calculate distance
        $earthRadius = 6371; // Earth's radius in kilometers

        return Partner::where('type', 'resturent')
            ->where('isActive', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->selectRaw("
                *,
                ({$earthRadius} * acos(
                    cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )) AS distance
            ", [$lat, $lng, $lat])
            ->having('distance', '<=', $radiusKm)
            ->orderBy('distance')
            ->limit(20)
            ->get();
    }

    public function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        return ZoneService::calculateDistance($lat1, $lng1, $lat2, $lng2);
    }

    public function render()
    {
        return view('livewire.frontend.web.restaurant');
    }
}
