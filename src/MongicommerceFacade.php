<?php

namespace Mongi\Mongicommerce;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mongi\Mongicommerce\Skeleton\SkeletonClass
 */
class MongicommerceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mongicommerce';
    }
}
