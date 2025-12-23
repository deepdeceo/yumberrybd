<?php

namespace App\Filament\Widgets;

use App\Models\AdminPanel;
use App\Models\Business\Cities;
use App\Models\Business\Zones;
use App\Models\User;
use App\Models\UserManagement\Partner;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int | array
    {
        return 4; // ৪টি কার্ড এক সারিতে থাকবে
    }

    public static function canView(): bool
    {
        $user = Auth::guard('admin')->user();
        return in_array($user->role, ['super_admin', 'operation_manager']);
    }

    protected function getStats(): array
    {
        return [
            // ১. Total Users - Success/Emerald Theme
            Stat::make('Total Users', User::count())
                ->description('Overall Growth')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 3, 15, 8, 20, 12, 25])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #f0fdf4, #ffffff); border-radius: 16px; border: 1px solid #dcfce7;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),

            // ২. Partners (User Table) - Gold/Amber Theme
            Stat::make('Partners (Users)', User::where('role', 'partner')->count())
                ->description('User Role Account')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('warning')
                ->chart([15, 10, 25, 15, 30, 20, 35])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #fffbeb, #ffffff); border-radius: 16px; border: 1px solid #fef3c7;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),

            // ৩. Business Profile - Blue/Indigo Theme (Premium Look)
            Stat::make('Partner Profiles', Partner::count())
                ->description('Business Verified')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('info')
                ->chart([10, 15, 8, 12, 18, 14, 25])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #eff6ff, #ffffff); border-radius: 16px; border: 1px solid #dbeafe;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-md ring-1 ring-blue-100'
                ]),

            // ৪. Riders - Sky Blue Theme
            Stat::make('Riders', User::where('role', 'rider')->count())
                ->description('On Field Crew')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info')
                ->chart([5, 12, 8, 18, 12, 22, 20])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #f0f9ff, #ffffff); border-radius: 16px; border: 1px solid #e0f2fe;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),

            // ৫. Cities - Danger/Rose Theme
            Stat::make('Cities', Cities::count())
                ->description('Operational Hubs')
                ->descriptionIcon('heroicon-m-map')
                ->color('danger')
                ->chart([2, 5, 3, 8, 5, 10, 12])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #fff1f2, #ffffff); border-radius: 16px; border: 1px solid #ffe4e6;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),

            // ৬. Zones - Primary/Indigo Theme
            Stat::make('Zones', Zones::count())
                ->description('Active Coverage')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary')
                ->chart([10, 20, 15, 30, 25, 40, 35])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #f5f3ff, #ffffff); border-radius: 16px; border: 1px solid #ede9fe;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),

            // ৭. Staff - Gray/Slate Theme
            Stat::make('Admin Staff', AdminPanel::count())
                ->description('Internal Team')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('gray')
                ->chart([2, 4, 3, 6, 5, 8, 7])
                ->extraAttributes([
                    'style' => 'background: linear-gradient(to top right, #f8fafc, #ffffff); border-radius: 16px; border: 1px solid #f1f5f9;',
                    'class' => 'hover:scale-105 transition-transform duration-300 shadow-sm'
                ]),
        ];
    }
}
