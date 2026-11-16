<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AllRoutesTest extends TestCase
{
    public function test_stable_public_routes_return_their_expected_statuses(): void
    {
        $contracts = [
            'login' => 200,
            'password.request' => 200,
            'register' => 200,
            'home-page' => 200,
            'about-us' => 200,
            'contact-us.index' => 200,
            'verify.index' => 200,
            'skill.index' => 200,
            'tour.index' => 200,
            'community.index' => 200,
            'privacy-policy.index' => 200,
            'sanctum.csrf-cookie' => 204,
        ];

        foreach ($contracts as $routeName => $expectedStatus) {
            $this->get(route($routeName))->assertStatus($expectedStatus);
        }
    }

    public function test_panel_routes_redirect_unauthenticated_users_to_login(): void
    {
        foreach (['manager-panel', 'admin-panel', 'teacher-panel', 'agent-panel', 'user-panel'] as $routeName) {
            $this->get(route($routeName))->assertRedirectToRoute('login');
        }
    }

    public function test_known_placeholders_remain_registered_without_claiming_runtime_health(): void
    {
        $registeredUris = collect(Route::getRoutes()->getRoutes())
            ->map(fn ($route) => $route->uri());

        foreach (['test', 'test2', 'mailable', 'blog'] as $placeholderUri) {
            $this->assertTrue(
                $registeredUris->contains($placeholderUri),
                "Expected placeholder route [{$placeholderUri}] to remain registered."
            );
        }

        foreach ([
            'laratrust.permissions.index',
            'laratrust.roles.index',
            'laratrust.roles-assignment.index',
        ] as $routeName) {
            $this->assertTrue(Route::has($routeName), "Expected route [{$routeName}] to remain registered.");
        }
    }
}
