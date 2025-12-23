<?php

namespace App\Filament\Partner\Pages;

use App\Models\Business\Cities;
use App\Models\Business\Zones;
use App\Models\UserManagement\Partner;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Form;
use Filament\Support\Icons\Heroicon;
use Livewire\WithFileUploads;
use UnitEnum;
class Business extends Page
{

    use WithFileUploads; // Use this

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsVertical;

    protected  string $view = 'filament.partner.pages.business';

        protected static string|UnitEnum|null $navigationGroup = 'Business Setup';


    public $logo; // Will hold the uploaded file
    public $banner;
    public $existingLogo; // To show current logo
    public $existingBanner;

    public $business_name = '';
    public $business_number = '';
    public $business_address = '';
    public $branch = '';
    public $partner_type = 'shop';
    public $latitude = 23.8103; // Default Dhaka
    public $longitude = 90.4125;
    public $cities = [];
    public $zones = [];
    public $selectedCity = null;
    public $selectedZone = null;
    public $total_branch = null;

    public function mount(): void
    {
        $this->cities = Cities::all();

        if ($partner = Partner::where('user_id', Auth::id())->first()) {
            $this->business_name = $partner->business_name;
            $this->business_number = $partner->business_number;
            $this->business_address = $partner->business_address;
            $this->total_branch = $partner->total_branch;
            $this->branch = $partner->branch;
            $this->latitude = $partner->latitude ?? 23.8103;
            $this->longitude = $partner->longitude ?? 90.4125;
            $this->selectedCity = $partner->cities;
            $this->selectedZone = $partner->zones_id;
            $this->partner_type = $partner->type;

            // যদি আগে থেকে সিটি সেভ করা থাকে তবে তার জোনগুলো লোড করা
            if ($this->selectedCity) {
                $this->zones = Zones::where('city_id', $this->selectedCity)->get();
            }
            $this->existingLogo = $partner->logo;
            $this->existingBanner = $partner->banner;
        }
    }

    public function updatedSelectedCity($cityId)
    {
        $this->zones = Zones::where('city_id', $cityId)->get();
        $this->selectedZone = null;
    }

    public function save(): void
    {

        $this->validate([
            'business_name' => 'required',
            'business_number' => 'required',
            'business_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'selectedCity' => 'required',
            'selectedZone' => 'required',
            'branch' => 'required',
            'total_branch' => 'nullable',
            'logo' => 'nullable|image|max:1024', // 1MB Max
            'banner' => 'nullable|image|max:2048', // 2MB Max
            'partner_type' => 'required|in:shop,restaurant,pharmacy,grocery',
        ]);

        $logoPath = $this->logo ? $this->logo->store('logos', 'public') : $this->existingLogo;
        $bannerPath = $this->banner ? $this->banner->store('banners', 'public') : $this->existingBanner;

        Partner::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'business_name' => $this->business_name,
                'business_number' => $this->business_number,
                'business_address' => $this->business_address,
                'branch' => $this->branch,
                'total_branch' => $this->total_branch,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'cities' => $this->selectedCity,
                'zones_id' => $this->selectedZone,
                'type' => $this->partner_type,
                'logo' => $logoPath,
                'banner' => $bannerPath,
            ]
        );

        Notification::make()
            ->title('Saved Successfully')
            ->success()
            ->send();
    }
}
