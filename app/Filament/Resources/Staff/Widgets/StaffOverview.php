<?php

namespace App\Filament\Resources\Staff\Widgets;

use App\Models\Staff;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StaffOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalStaff = Staff::count();
        $activeStaff = Staff::where('is_active', true)->count();
        $inactiveStaff = Staff::where('is_active', false)->count();

        // Count by specialty type
        $doctors = Staff::where('specialty', 'like', '%dr.%')
            ->orWhere('specialty', 'like', '%Dokter%')
            ->count();

        $midwives = Staff::where('specialty', 'like', '%Bidan%')->count();
        $nurses = Staff::where('specialty', 'like', '%Perawat%')->orWhere('specialty', 'like', '%Ns.%')->count();
        $dentists = Staff::where('specialty', 'like', '%drg%')->count();

        // Count staff with social media
        $withInstagram = Staff::whereNotNull('instagram')->count();
        $withWhatsapp = Staff::whereNotNull('whatsapp')->count();
        $withEmail = Staff::whereNotNull('email')->count();

        return [
            Stat::make('Total Staff', $totalStaff)
                ->description('Semua karyawan')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Staff Aktif', $activeStaff)
                ->description('Status aktif bekerja')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Staff Tidak Aktif', $inactiveStaff)
                ->description('Status non-aktif')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Dokter Umum/Spesialis', $doctors)
                ->description('Tenaga medis dokter')
                ->descriptionIcon('heroicon-m-user-circle')
                ->color('info'),

            Stat::make('Bidan', $midwives)
                ->description('Tenaga medis kebidanan')
                ->descriptionIcon('heroicon-m-heart')
                ->color('secondary'),

            Stat::make('Perawat', $nurses)
                ->description('Tenaga medis keperawatan')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('success'),

            Stat::make('Dokter Gigi', $dentists)
                ->description('Tenaga medis gigi')
                ->descriptionIcon('heroicon-m-face-smile')
                ->color('warning'),

            Stat::make('Dengan Instagram', $withInstagram)
                ->description('Staff dengan akun IG')
                ->descriptionIcon('heroicon-m-at-symbol')
                ->color('primary'),
        ];
    }
}
