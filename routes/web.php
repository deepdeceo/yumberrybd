<?php

use App\Livewire\Frontend\Web\LandingPages;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPages::class)->name('home');

include 'partner/web_site.php';
