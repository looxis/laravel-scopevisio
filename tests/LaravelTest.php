<?php

namespace Looxis\Laravel\ScopeVisio\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase;
use Looxis\Laravel\ScopeVisio\ScopeVisioFacade;
use Looxis\Laravel\ScopeVisio\ScopeVisioServiceProvider;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ScopeVisioServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ScopeVisio' => ScopeVisioFacade::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app->useEnvironmentPath(__DIR__ . '/..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);
        $app->useStoragePath(__DIR__.'/../storage');
    }

    /** @test */
    public function laravel_testing_environment_booted()
    {
        $this->assertTrue(app()->environment('testing'));
    }
}
