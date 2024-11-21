<?php

use App\Enum\UserTypeEnum;
use App\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\{actingAs, get};

describe('Admin Dashboard', function () {
    beforeEach(function () {
        $this->adminUser = User::factory()->create([
            'user_type' => UserTypeEnum::ADMIN->value,
        ]);
    });

    it('allows an authenticated admin to view the dashboard page', function () {
        actingAs($this->adminUser);

        get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertViewIs('backend.dashboard')
            ->assertSee('Welcome to the Hotelia Dashboard');
    });

    it('restricts access to the dashboard for unauthenticated users', function () {
        get(route('admin.dashboard'))
            ->assertStatus(Response::HTTP_FOUND);
    });
});
