<?php

use App\Enum\UserTypeEnum;
use App\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\{get, post, actingAs, assertAuthenticatedAs};

describe('Admin Login', function () {
    it('shows the admin login page', function () {
        get(route('admin.showLoginPage'))
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('backend.auth.login')
            ->assertSeeInOrder(['Email', 'Password', 'Login']);
    });

    describe('Authentication', function () {
        beforeEach(function () {
            $this->user = User::factory()->create([
                'password' => bcrypt('123'),
                'user_type' => UserTypeEnum::ADMIN->value,
            ]);
            $this->regularUser = User::factory()->create([
                'user_type' => UserTypeEnum::REGULAR_USER->value,
            ]);
        });

        it('redirects to the dashboard if admin logs in successfully', function () {
            post(route('admin.login'), [
                'email' => $this->user->email,
                'password' => '123',
            ])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect(route('admin.dashboard'));
            assertAuthenticatedAs($this->user);
        });

        it('cannot access the login page if admin is authenticated', function () use ($user) {
            actingAs($this->user)
                ->get(route('admin.showLoginPage'))
                ->assertRedirect('/');
        });

        it('restricts access to the dashboard for regular users', function () {
            actingAs($this->regularUser)
            ->get(route('admin.dashboard'))
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Access denied. Admins only.');
        });

        describe('Validation', function () {
          
            it('fails without filling credentials', function () {
                post(route('admin.login'))
                    ->assertStatus(Response::HTTP_FOUND)
                    ->assertSessionHasErrors(['email', 'password']);
            });

            it('fails with invalid email format', function () {
                post(route('admin.login'), ['email' => 'invalid'])
                    ->assertSessionHasErrors('email');
            });

            it('fails with non-existent email', function () {
                post(route('admin.login'), ['email' => 'nonexistent@example.com', 'password' => '123'])
                    ->assertSessionHasErrors('email');
            });
        });
    });
});
