<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyPageTest extends TestCase
{
    /**
     * route test
     *
     * @return void
     */
    public function test_route()
    {
        $this->get(route('verify.index'))->assertSuccessful();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_status()
    {
        $response = $this->get(route('verify.index'));
        $response->assertStatus(200);
    }
}
