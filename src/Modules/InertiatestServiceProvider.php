<?php

namespace Inertiatest;

use Inertiatest\Affiliate\Providers\AffiliateServiceProvider;
use Inertiatest\Authentication\Providers\AuthenticationServiceProvider;
use Inertiatest\Browser\Providers\BrowserServiceProvider;
use Inertiatest\Course\Providers\CourseServiceProvider;
use Inertiatest\Newsletter\Providers\NewsletterServiceProvider;
use Inertiatest\Payment\Providers\PaymentServiceProvider;
use Inertiatest\Player\Providers\PlayerServiceProvider;
use Inertiatest\Settings\Providers\SettingsServiceProvider;
use Inertiatest\Waitlist\Providers\WaitlistServiceProvider;
use Illuminate\Support\ServiceProvider;
use Vinkla\Hashids\HashidsServiceProvider;

class InertiatestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(BrowserServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //dd()
    }
}
