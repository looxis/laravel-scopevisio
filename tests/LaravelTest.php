<?php

namespace Looxis\Laravel\ScopeVisio\Tests;

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

    /** @test */
    public function laravel_testing_environment_booted()
    {
        $this->assertTrue(app()->environment('testing'));
    }
}
