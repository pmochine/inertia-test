<?php

namespace Inertiatest\Tests;

use Inertiatest\Tests\Fixtures\User;
use Inertia\Inertia;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // https://github.com/keithbrink/affiliates-spark/blob/master/tests/TestCase.php
        // this helps so that don't need to use RefreshDatabase trait all the time.
        // We try to avoid that, for higher speed testing.
        // And plus we don't need to use defineDatabaseMigrations
        //  https://packages.tools/testbench/basic/define-databases.html#manually-execute-migrations
        View::addLocation(__DIR__.'/Stubs');
        
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->artisan('migrate', [
            '--database' => 'testbench',
        ])->run();

        //Load routes for testing
        app('files')->getRequire(__DIR__ . '/Fixtures/routes/web.php');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Inertiatest\InertiatestServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     * https://packages.tools/testbench/basic/define-environment.html#using-annotation
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Damit kann ich den UserLeicht einloggen.
     *
     * @param   [type]  $user   [$user description]
     * @param   string  $guard  null oder 'api'
     *
     * @return  [type]          [return description]
     */
    public function signIn($user = null, ?string $guard = null)
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user, $guard);

        return $this;
    }

    public function signInAPI($user = null)
    {
        return $this->signIn($user, 'api');
    }

    public function logOut()
    {
        if (auth()->check()) {
            auth()->logout();
        }

        return $this;
    }
}
