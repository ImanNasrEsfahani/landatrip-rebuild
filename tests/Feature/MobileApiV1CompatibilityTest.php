<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class MobileApiV1CompatibilityTest extends TestCase
{
    use DatabaseTransactions;

    public function test_mobile_v1_route_inventory_and_sanctum_middleware_are_preserved(): void
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->filter(fn ($route) => str_starts_with($route->uri(), 'api/app/v1/'));

        $this->assertCount(49, $routes);

        $protectedRoute = $routes->first(
            fn ($route) => $route->uri() === 'api/app/v1/get' && in_array('GET', $route->methods(), true)
        );

        $this->assertNotNull($protectedRoute);
        $this->assertContains('auth:sanctum', $protectedRoute->middleware());
    }

    public function test_mobile_v1_rejects_missing_tokens_and_accepts_sanctum_tokens(): void
    {
        $this->getJson('/api/app/v1/get')->assertUnauthorized();

        Event::fake();
        $user = User::query()->create([
            'fname' => 'Mobile',
            'lname' => 'Regression',
            'slug' => 'mobile-regression-user',
            'email' => 'mobile-regression@example.test',
            'password' => 'not-used-by-this-test',
            'sex' => 1,
        ]);
        $token = $user->createToken('mobile-v1-regression', ['*']);

        $this->assertNotEmpty($token->plainTextToken);
        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_type' => User::class,
            'tokenable_id' => $user->getKey(),
            'name' => 'mobile-v1-regression',
        ]);

        $this->withToken($token->plainTextToken)
            ->getJson('/api/app/v1/get')
            ->assertOk()
            ->assertJson(['data', 'Salam']);
    }
}
