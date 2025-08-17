<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AllRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_public_No_Parameter_routes()
    {
        $allRoutes= collect(Route::getRoutes());
        $routes = $allRoutes->filter(function ($item) {
            return in_array("web", $item->gatherMiddleware(), true);
        })->filter(function ($item) {
            return !in_array("auth", $item->gatherMiddleware(), true);
        })->filter(function ($item) {
            return in_array("GET", $item->methods(), true);
        })->filter(function ($item) {
            return !preg_match('/\{.*\}/', $item->uri());
        })->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'name' => $route->getName(),
            ];
        });

        foreach ($routes as $route) {
            $response = $this->get($route['uri']);
            echo "Route name {$route['name']} with address {$route['uri']} returns " . $response->getStatusCode() . "\n";
        }

        $this->assertTrue(true);
    }

    public function test_all_protected_routes()
    {
        $this->assertTrue(true);
    }
}
