<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\PartnerRegister;
use App\Filament\Partner\Pages\Business;
use App\Filament\Partner\Pages\SetupBank;
use App\Filament\Partner\Widgets\Setupwidgets;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PartnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('partner')
            ->path('partner')
            ->viteTheme('resources/css/filament/partner/theme.css')
            ->registration(PartnerRegister::class)
            ->login()
            ->spa()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->renderHook(
                'panels::head.start', // এটি প্যানেলের একদম শুরুতে আপনার CSS ফাইলটি ইনজেক্ট করবে
                fn(): string => Blade::render("@vite(['resources/css/app.css', 'resources/js/app.js'])"),
            )
            ->discoverResources(in: app_path('Filament/Partner/Resources'), for: 'App\Filament\Partner\Resources')
            ->discoverPages(in: app_path('Filament/Partner/Pages'), for: 'App\Filament\Partner\Pages')
            ->pages([
                Dashboard::class,
                Business::class,
                SetupBank::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Partner/Widgets'), for: 'App\Filament\Partner\Widgets')
            ->widgets([
                Setupwidgets::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
