<?php

use App\Livewire\Partner\Web\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/become-a-partner', LandingPage::class)->name('partner.landing.page');
