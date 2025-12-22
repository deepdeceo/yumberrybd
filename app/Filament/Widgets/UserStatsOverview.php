<?php

namespace App\Filament\Widgets;

use App\Models\AdminPanel;
use App\Models\Business\Cities;
use App\Models\Business\Zones;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends BaseWidget
{

 protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int | array
    {
        return 4; // 4 stats inline
    }

    public static function canView(): bool
    {
        $user = Auth::guard('admin')->user();

        return in_array($user->role, ['super_admin', 'operation_manager']);
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->columnSpan(1)
                ->chart([7, 3, 10, 2, 12, 5, 18]), // এই অ্যারেটি গ্রাফের লাইন তৈরি করবে

            Stat::make('Partners', User::where('role', 'partner')->count())
                ->description('Active shops')
                ->color('warning')
                ->columnSpan(1)
                ->chart([15, 4, 10, 2, 12, 4, 7]),

            Stat::make('Riders', User::where('role', 'rider')->count())
                ->description('Delivery crew')
                ->color('info')
                ->columnSpan(1)
                ->chart([2, 10, 5, 12, 8, 15, 20]),

            Stat::make('Cities', Cities::count())
                ->description('Services Areas')
                ->color('danger')
                ->columnSpan(1)
                ->chart([2, 10, 5, 12, 8, 15, 20]),

            Stat::make('Zones', Zones::count())
                ->description('Our Zones')
                ->color('primary')
                ->columnSpan(1)
                ->chart([2, 10, 5, 12, 8, 15, 20]),

            Stat::make('AdminPanels', AdminPanel::count())
                ->description('Total Staff')
                ->color('gray')
                ->columnSpan(1)
                ->chart([2, 10, 5, 12, 8, 15, 20]),
        ];
    }
}
