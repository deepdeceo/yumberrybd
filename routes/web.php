<?php

use App\Livewire\Frontend\Web\LandingPages;
use App\Livewire\Frontend\Web\MainCategory;
use App\Livewire\Frontend\Web\Restaurant;
use App\Livewire\Frontend\Web\SingleRestaurant;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPages::class)->name('home');
Route::get('/restaurant/{lat?}/{lng?}', Restaurant::class)->name('web.main.restaurant');
Route::get('/food/restaurant/{id}', SingleRestaurant::class)->name('web.main.restaurant.single');
Route::get('/{slug}', MainCategory::class)->name('web.main.categories');
include 'partner/web_site.php';
