<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * route test
     *
     * @return void
     */
    public function test_route()
    {
        $this->get(route('home-page'))->assertSuccessful();
    }

    /**
     * status test
     *
     * @return void
     */
    public function test_status()
    {
        $response = $this->get(route('home-page'));
        $response->assertStatus(200);
    }
}
