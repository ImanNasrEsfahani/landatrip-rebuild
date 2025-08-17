<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactusPageTest extends TestCase
{
    /**
     * route test
     *
     * @return void
     */
    public function test_route()
    {
        $response = $this->get(route('contact-us.index'))->assertSuccessful();
    }

    /**
     * status test
     *
     * @return void
     */
    public function test_status()
    {
        $response = $this->get(route('contact-us.index'));
        $response->assertStatus(200);
    }
}
