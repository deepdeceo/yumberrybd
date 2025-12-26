<?php

use App\Livewire\Frontend\Web\Auth\CreateUser;
use App\Livewire\Frontend\Web\Auth\Login;
use App\Livewire\Frontend\Web\LandingPages;
use App\Livewire\Frontend\Web\MainCategory;
use App\Livewire\Frontend\Web\Restaurant;
use App\Livewire\Frontend\Web\SingleRestaurant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', LandingPages::class)->name('home');
Route::get('/register', CreateUser::class)->name('register');
Route::get('/login', Login::class)->name('login');

Route::get('/restaurant/{lat?}/{lng?}', Restaurant::class)->name('web.main.restaurant');
Route::get('/food/restaurant/{id}', SingleRestaurant::class)->name('web.main.restaurant.single');
Route::get('/{slug}', MainCategory::class)->name('web.main.categories');
Route::get('create/user', CreateUser::class)->name('create.user');


include 'partner/web_site.php';
