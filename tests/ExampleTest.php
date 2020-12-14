<?php

namespace Mongi\Mongicommerce\Tests;

use Orchestra\Testbench\TestCase;
use Mongi\Mongicommerce\MongicommerceServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [MongicommerceServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
