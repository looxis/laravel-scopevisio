<?php

namespace Looxis\Laravel\ScopeVisio\Tests;

class ScopeVisioTest extends LaravelTest
{
    /** @test */
    public function sandbox()
    {
        $this->assertTrue(\ScopeVisio::getConfig('sandbox'));
    }
}
