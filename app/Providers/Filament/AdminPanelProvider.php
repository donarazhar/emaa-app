<?php

namespace App\Providers\Filament;

use App\Filament\Resources\KursusPendaftaranResource\Widgets\KursusChart;
use App\Filament\Resources\MarbotResource\Widgets\DataMarbotWidget;
use App\Filament\Resources\MarbotResource\Widgets\MarbotTable;
use App\Filament\Resources\MarbotResource\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Filament\Pages\Auth\EditProfile as AuthEditProfile;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile(AuthEditProfile::class)
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'primary' => Color::Blue,
                'info' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('Poppins')
            // ->brandName('E-MAA')
            ->favicon(asset('storage/file-web/maa-icon-152x152.png'))
            ->brandLogo(asset('storage/file-web/logo.png'))
            ->brandLogoHeight('3rem')
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ])
            ->topNavigation() // Bilah Top Navigasi
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                StatsOverview::class,
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                MarbotTable::class,
                KursusChart::class,
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
            ])
            ->plugins([
                FilamentApexChartsPlugin::make()
            ]);
    }
}
