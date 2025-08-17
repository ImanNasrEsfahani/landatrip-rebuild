<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutusPageTest extends TestCase
{
    /**
     * route test
     *
     * @return void
     */
    public function test_route()
    {
        $this->get(route('about-us'))->assertSuccessful();
    }

    /**
     * status test
     *
     * @return void
     */
    public function test_status()
    {
        $response = $this->get(route('about-us'));
        $response->assertStatus(200);
    }
}
