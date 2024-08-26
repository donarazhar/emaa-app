<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\AccountWidget;
use App\Filament\Widgets\LaporKerjaBlog;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\GrafikMarbotChart;
use App\Filament\Widgets\FilamentInfoWidget;
use App\Filament\Widgets\GrafikInventarisChart;
use App\Filament\Widgets\GrafikKonsultasiChart;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Widgets\GrafikPengislamanChart;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Widgets\GrafikPengisianKasChart;
use App\Filament\Widgets\GrafikPengeluaranKasChart;
use App\Filament\Widgets\GrafikMarbotPerPosisiChart;
use App\Filament\Widgets\GrafikPersuratanByAsalChart;
use App\Filament\Widgets\GrafikPersuratanByTimeChart;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use App\Filament\Widgets\GrafikPersuratanByCategoryChart;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->databaseNotifications()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            // ->profile(AuthEditProfile::class)
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Zinc,
                'info' => Color::Amber,
                'primary' => Color::Blue,
                'success' => Color::Green,
                'warning' => Color::Yellow,
            ])
            ->darkMode(isForced: true)
            ->font('Poppins')
            ->brandName('EMAA - Masjidku')
            ->favicon(asset('storage/logo-maa.png'))
            ->navigationGroups([
                'Blog Management',
                'Office Management',
                'Kursus Management',
                'Setting Management',

            ])
            ->sidebarFullyCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
                GrafikMarbotChart::class,
                GrafikMarbotPerPosisiChart::class,
                LaporKerjaBlog::class,
                GrafikPersuratanByTimeChart::class,
                GrafikPersuratanByCategoryChart::class,
                GrafikPersuratanByAsalChart::class,
                GrafikKonsultasiChart::class,
                GrafikPengislamanChart::class,
                GrafikPengisianKasChart::class,
                GrafikPengeluaranKasChart::class,
                GrafikInventarisChart::class,

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
                FilamentApexChartsPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->slug('my-profile')
                    ->setTitle('My Profile')
                    ->setNavigationLabel('My Profile')
                    ->setNavigationGroup('Setting Management')
                    ->setIcon('heroicon-m-user-circle')
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'file-avatars', // image will be stored in 'storage/app/public/avatars
                        rules: 'mimes:jpeg,png|max:1024' //only accept jpeg and png files with a maximum size of 1MB
                    ),
            ]);
    }
}
