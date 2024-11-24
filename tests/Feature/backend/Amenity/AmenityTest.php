<?php

use App\Models\Amenity;
use Illuminate\Http\Response;

use function Pest\Laravel\{get};

describe('Amenity Management', function () {
    it('allows admin to view amenity list', function () {
        asAdmin()
            ->get(route('admin.rooms.amenities.index'))
            ->assertViewIs('backend.amenities.index')
            ->assertSee('Amenities DataTable')
            ->assertStatus(Response::HTTP_OK);
    });

    it('allows admin to access amenity creation page', function () {
        asAdmin()
            ->get(route('admin.rooms.amenities.create'))
            ->assertViewIs('backend.amenities.create')
            ->assertStatus(Response::HTTP_OK);
    });

    it('denies access to amenity pages for unauthorized users', function () {
        get(route('admin.rooms.amenities.index'))
            ->assertStatus(Response::HTTP_FOUND);
    });

    it('restricts regular users from accessing amenity pages', function () {
        asUser()
            ->get(route('admin.rooms.amenities.index'))
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Access denied. Admins only.');
    });

    it('allows admin to create a new amenity with valid data', function () {
        asAdmin()
            ->post(route('admin.rooms.amenities.store'), [
                'name' => 'Amenity Name',
                'position' => 1,
                'status' => 'active',
            ])
            ->assertRedirect(route('admin.rooms.amenities.index'));
    });

    it('allows admin to update an existing amenity with valid data', function () {
        $amenity = Amenity::factory()->create();

        asAdmin()
            ->put(route('admin.rooms.amenities.update', $amenity->id), [
                'name' => 'Updated Name',
                'position' => '1',
                'status' => 'inactive',
            ])
            ->assertRedirect(route('admin.rooms.amenities.index'));
    });

    it('restricts non-admin users from updating amenities', function () {
        $amenity = Amenity::factory()->create();

        asUser()
            ->put(route('admin.rooms.amenities.update', $amenity->id), [
                'name' => 'Unauthorized Update',
            ])
            ->assertRedirect('/')
            ->assertSessionHas('error', 'Access denied. Admins only.');
    });

    it('allows admin to delete an existing amenity', function () {
        $amenity = Amenity::factory()->create();

        asAdmin()
            ->delete(route('admin.rooms.amenities.destroy', $amenity->id))
            ->assertRedirect(route('admin.rooms.amenities.index'));
    });

    it('displays 404 for non-existent amenity access', function () {
        asAdmin()
            ->get(route('admin.rooms.amenities.edit', 999)) // Non-existent amenity ID
            ->assertStatus(Response::HTTP_NOT_FOUND);
    });

    describe('validates', function () {
        it('validates required fields for amenity creation', function () {
            asAdmin()
            ->post(route('admin.rooms.amenities.store'), [])
            ->assertSessionHasErrors(['name', 'position']);
        });

        it('validates amenity name uniqueness during creation', function () {
            Amenity::factory()->create(['name' => 'Duplicate Name']);

            asAdmin()
            ->post(route('admin.rooms.amenities.store'), [
                'name' => 'Duplicate Name',
                'status' => 'active',
                'position' => 1
            ])
            ->assertSessionHasErrors(['name']);
        });

        it('validates required fields for amenity update', function () {
            $amenity = Amenity::factory()->create();
            asAdmin()
            ->put(route('admin.rooms.amenities.update', $amenity->id), [])
            ->assertSessionHasErrors(['name', 'position']);
        });

        it('validates amenity name length', function () {
            asAdmin()
            ->post(route('admin.rooms.amenities.store'), [
                'name' => str_repeat('A', 256), // Exceeding length
                'status' => 'active',
                'position' => 1
            ])
            ->assertSessionHasErrors(['name']);
        });

        it('validates amenity status during creation', function () {
            asAdmin()
            ->post(route('admin.rooms.amenities.store'), [
                'name' => 'Valid Name',
                'position' => 1,
                'status' => 'invalid_status', // Invalid status
            ])
            ->assertSessionHasErrors(['status']);
        });

        it('validates amenity position during creation', function () {
            asAdmin()
            ->post(route('admin.rooms.amenities.store'), [
                'name' => 'Valid Name',
                'position' => 'abc',
                'status' => 'active',
            ])
            ->assertSessionHasErrors(['position']);
        });
    });
});
