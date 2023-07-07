<?php

namespace Tests\Feature\Http\Controllers\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Pennant\Feature;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function seeBasicTitle()
    {
        $this->get('/')
            ->assertSeeText('Categories')
            ->assertSeeText('Just For You');
    }

    #[Test]
    public function seeLoginItemWhenOperationFeatureOn()
    {
        Feature::activate('operation');

        $this->get('/catalog')
            ->assertSeeText('Track my order')
            ->assertSeeText('Login')
            ->assertSeeText('Sign up');
    }

    #[Test]
    public function dontSeeLoginItemWhenOperationFeatureOff()
    {
        Feature::deactivate('operation');

        $this->get('/catalog')
            ->assertDontSeeText('Track my order')
            ->assertDontSeeText('Login')
            ->assertDontSeeText('Sign up');
    }
}
