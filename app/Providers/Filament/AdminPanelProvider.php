<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\BlogStatsWidget;
use App\Filament\Widgets\BlogsChart;
use App\Filament\Widgets\StaffStatsWidget;
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
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->favicon(asset('images/logoupt.webp'))
            ->login()
            ->sidebarCollapsibleOnDesktop(true)
            ->darkModeBrandLogo(asset('images/logo-uptd-dark.webp'))
            ->brandLogo(asset('images/logo-uptd-light.webp'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => [
                    50 => '#fdf4f9',
                    100 => '#fbe8f3',
                    200 => '#f8d1e9',
                    300 => '#f3aad5',
                    400 => '#ea7cb8',
                    500 => '#cf7cb2',
                    600 => '#c45d94',
                    700 => '#a84877',
                    800 => '#8b3d62',
                    900 => '#743654',
                    950 => '#471b30',
                ],
                'secondary' => [
                    50 => '#f0fbfd',
                    100 => '#d8f4f9',
                    200 => '#b6e9f3',
                    300 => '#83d9e9',
                    400 => '#61cade',
                    500 => '#2fa7be',
                    600 => '#2a86a0',
                    700 => '#286d82',
                    800 => '#285a6b',
                    900 => '#254b5a',
                    950 => '#14313d',
                ],
                'success' => [
                    50 => '#f0fdfc',
                    100 => '#ccfbf6',
                    200 => '#99f6ed',
                    300 => '#5eeade',
                    400 => '#2dd4c6',
                    500 => '#0cab9c',
                    600 => '#0a9387',
                    700 => '#0e746d',
                    800 => '#115d58',
                    900 => '#134d49',
                    950 => '#042f2d',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                BlogStatsWidget::class,
                StaffStatsWidget::class,
                BlogsChart::class,
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
