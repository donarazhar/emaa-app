<?php

namespace App\Providers;

use App\Events\PromoteMarbot;
use App\Listeners\SendPromotedEmail;
use App\Listeners\UpdateMarbotStandard;
use Filament\Events\Auth\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ],
        PromoteMarbot::class => [
            UpdateMarbotStandard::class,
            SendPromotedEmail::class,
        ],
    ];
}
