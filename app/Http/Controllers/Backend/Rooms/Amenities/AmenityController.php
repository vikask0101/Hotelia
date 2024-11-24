<?php

namespace App\Http\Controllers\Backend\Rooms\Amenities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Amenity\StoreAmenityRequest;
use App\Http\Requests\Backend\Amenity\UpdateAmenityRequest;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index()
    {
        return view('backend.amenities.index', [
            'amenities' => Amenity::all()
        ]);
    }

    public function create()
    {
        return view('backend.amenities.create');
    }

    public function store(StoreAmenityRequest $request)
    {
        try {
            Amenity::createAmenity($request->validated());
            return redirect()->route('admin.rooms.amenities.index')->with('success', 'Amenity created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Amenity $amenity)
    {
        return view('backend.amenities.edit', compact('amenity'));
    }

    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        try {
            $amenity->updateAmenity($request->validated());
            return redirect()->route('admin.rooms.amenities.index')->with('success', 'Amenity updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()->route('admin.rooms.amenities.index')->with('success', 'Amenity deleted successfully!');
    }

    public function updateStatus(Request $request, Amenity $amenity)
    {
        $amenity->updateStatus($request->input('status'));

        return redirect()->route('admin.rooms.amenities.index')->with('success', 'Amenity status updated successfully!');
    }
}
