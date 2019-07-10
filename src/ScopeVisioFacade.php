<?php

namespace Looxis\Laravel\ScopeVisio;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Looxis\Laravel\ScopeVisio\Skeleton\SkeletonClass
 */
class ScopeVisioFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'scopevisio';
    }
}
