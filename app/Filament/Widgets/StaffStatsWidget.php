<?php

namespace App\Filament\Widgets;

use App\Models\Staff;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalStaff = Staff::count();
        $activeStaff = Staff::where('is_active', true)->count();
        $inactiveStaff = Staff::where('is_active', false)->count();
        $activePercentage = $totalStaff > 0 ? round(($activeStaff / $totalStaff) * 100) : 0;

        // Count by specialty
        $doctors = Staff::where('specialty', 'like', '%dr.%')->orWhere('specialty', 'like', '%Dokter%')->count();
        $nurses = Staff::where('specialty', 'like', '%Bidan%')->orWhere('specialty', 'like', '%Perawat%')->count();

        return [
            Stat::make('Total Staff', $totalStaff)
                ->description('Semua karyawan')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary')
                ->chart([5, 7, 8, 9, 9, 9, $totalStaff]),

            Stat::make('Staff Aktif', $activeStaff)
                ->description($activePercentage . '% dari total')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([4, 6, 7, 8, 8, 8, $activeStaff]),

            Stat::make('Dokter', $doctors)
                ->description('Tenaga medis dokter')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('info'),

            Stat::make('Perawat & Bidan', $nurses)
                ->description('Tenaga medis perawat')
                ->descriptionIcon('heroicon-m-heart')
                ->color('secondary'),
        ];
    }
}
