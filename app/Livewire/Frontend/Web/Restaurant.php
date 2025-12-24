<?php

namespace App\Livewire\Frontend\Web;

use App\Models\Business\Zones;
use App\Models\UserManagement\Partner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]

class Restaurant extends Component
{
    public float $lat;
    public float $lng;
    public ?int $zoneId = null;
    public $restaurants = [];

    public function mount($lat = null, $lng = null)
    {
        if ($lat && $lng) {
            $this->lat = $lat;
            $this->lng = $lng;

            $this->zoneId = $this->detectZone($lat, $lng);
        }

        $this->loadRestaurants();
    }

    protected function detectZone($lat, $lng): ?int
    {
        $zones = Zones::where('is_active', true)->get();

        foreach ($zones as $zone) {
            $polygon = $zone->location['coordinates'][0]; // main ring

            if ($this->pointInPolygon([$lng, $lat], $polygon)) {
                return $zone->id;
            }
        }

        return null;
    }

    protected function pointInPolygon(array $point, array $polygon): bool
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

    protected function loadRestaurants()
    {
        if ($this->zoneId) {
            // Get restaurants in the detected zone
            $this->restaurants = Partner::where('type', 'resturent')
                ->where('zones_id', $this->zoneId)
                ->where('isActive', true)
                ->get();
        } else {
            // If no zone detected, get all active restaurants (fallback)
            $this->restaurants = Partner::where('type', 'resturent')
                ->where('isActive', true)
                ->limit(20)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.frontend.web.restaurant');
    }
}
