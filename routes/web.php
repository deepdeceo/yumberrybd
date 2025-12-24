<?php

use App\Livewire\Frontend\Web\LandingPages;
use App\Livewire\Frontend\Web\MainCategory;
use App\Livewire\Frontend\Web\Restaurant;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPages::class)->name('home');
Route::get('/restaurant', Restaurant::class)->name('web.main.restaurant');
Route::get('/{slug}', MainCategory::class)->name('web.main.categories');
include 'partner/web_site.php';
