<?php

use App\Models\Category;
use Illuminate\Http\Response;

use function Pest\Laravel\{get};

describe('Category Management', function () {
    it('allows admin to view category list', function () {
        asAdmin()
            ->get(route('admin.categories.index'))
            ->assertViewIs('backend.categories.index')
            ->assertSee('Category DataTable')
            ->assertStatus(Response::HTTP_OK);
    });

    it('allows admin to access category creation page', function () {
        asAdmin()
            ->get(route('admin.categories.create'))
            ->assertViewIs('backend.categories.create')
            ->assertStatus(Response::HTTP_OK);
    });

    it('denies access to category pages for unauthorized users', function () {
        get(route('admin.categories.index'))
            ->assertStatus(Response::HTTP_FOUND);
    });

    it('restricts regular users from accessing category pages', function () {
        asUser()
            ->get(route('admin.categories.index'))
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Access denied. Admins only.');
    });

    it('allows admin to create a new category with valid data', function () {
        asAdmin()
            ->post(route('admin.categories.store'), [
                'name' => 'Category Name',
                'position' => 1,
                'status' => 'active',
            ])
            ->assertRedirect(route('admin.categories.index'));
    });

    it('allows admin to update an existing category with valid data', function () {
        $category = Category::factory()->create();

        asAdmin()
            ->put(route('admin.categories.update', $category->id), [
                'name' => 'Updated Name',
                'position' => '1',
                'status' => 'inactive',
            ])
            ->assertRedirect(route('admin.categories.index'));
    });

    it('restricts non-admin users from updating categories', function () {
        $category = Category::factory()->create();

        asUser()
            ->put(route('admin.categories.update', $category->id), [
                'name' => 'Unauthorized Update',
            ])
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Access denied. Admins only.');
    });

    it('allows admin to delete an existing category', function () {
        $category = Category::factory()->create();

        asAdmin()
            ->delete(route('admin.categories.destroy', $category->id))
            ->assertRedirect(route('admin.categories.index'));
    });

    it('displays 404 for non-existent category access', function () {
        asAdmin()
            ->get(route('admin.categories.edit', 999)) // Non-existent category ID
            ->assertStatus(Response::HTTP_NOT_FOUND);
    });

    describe('validates', function () {
        it('validates required fields for category creation', function () {
            asAdmin()
            ->post(route('admin.categories.store'), [])
            ->assertSessionHasErrors(['name', 'position']);
        });

        it('validates category name uniqueness during creation', function () {
            Category::factory()->create(['name' => 'Duplicate Name']);

            asAdmin()
            ->post(route('admin.categories.store'), [
                'name' => 'Duplicate Name',
                'status' => 'active',
                'position' => 1
            ])
            ->assertSessionHasErrors(['name']);
        });

        it('validates required fields for category update', function () {
            $category = Category::factory()->create();
            asAdmin()
            ->put(route('admin.categories.update', $category->id), [])
            ->assertSessionHasErrors(['name', 'position']);
        });

        it('validates category name length', function () {
            asAdmin()
            ->post(route('admin.categories.store'), [
                'name' => str_repeat('A', 256), // Exceeding length
                'status' => 'active',
                'position' => 1
            ])
            ->assertSessionHasErrors(['name']);
        });

        it('validates category status during creation', function () {
            asAdmin()
            ->post(route('admin.categories.store'), [
                'name' => 'Valid Name',
                'position' => 1,
                'status' => 'invalid_status', // Invalid status
            ])
            ->assertSessionHasErrors(['status']);
        });

        it('validates category position during creation', function () {
            asAdmin()
            ->post(route('admin.categories.store'), [
                'name' => 'Valid Name',
                'position' => 'abc',
                'status' => 'active',
            ])
            ->assertSessionHasErrors(['position']);
        });
    });
});
