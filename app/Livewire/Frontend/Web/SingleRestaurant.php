<?php

namespace App\Livewire\Frontend\Web;

use App\Models\Business\Categories;
use App\Models\UserManagement\Partner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.main.web')]

class SingleRestaurant extends Component
{
    public $partner;
    public $distance; // km
    public $estimatedTime;
    public $ctg;

    public function mount($id)
    {
        // ID onujayi partner find korbe, na pele 404 dekhabe
        $this->partner = Partner::findOrFail($id);

        // Dummy user location (Dhaka)
        $userLat = 24.3666079;
        $userLng = 88.6158433;

        $this->distance = $this->calculateDistance(
            $userLat,
            $userLng,
            $this->partner->latitude,
            $this->partner->longitude
        );



        // Total ETA
        $this->estimatedTime = $this->partner->average_preparation_time ?? 15;

        $this->ctg = Categories::where('type', 'resturent')->get();

    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // KM

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 +
            cos(deg2rad($lat1)) *
            cos(deg2rad($lat2)) *
            sin($dLon / 2) ** 2;

        $c = 2 * asin(sqrt($a));

        return round($earthRadius * $c, 2);
    }

    public function render()
    {
        return view('livewire.frontend.web.single-restaurant');
    }
}
