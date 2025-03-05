<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Vehiclecat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
        ];
    }

    public function index(Request $request)
    {
        $vehicles = Vehicle::latest();

        $search = $request->search;

        if ($search) {
            $vehicles = $vehicles->where('brand_name', 'like', "%$search%");
        }

        $vehicles = $vehicles->paginate(8);

        return view('dashboard.vehicle-rental.index', compact('vehicles', 'search'));
    }

    public function create()
    {
        $vehicleCategories = Vehiclecat::all();
        return view('dashboard.vehicle-rental.create', compact('vehicleCategories'));
    }

    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'brand_name' => 'required|max:255|unique:vehicles',
            'rental_price' => 'required|integer',
            'color' => 'nullable',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'policy' => 'required',
            'information' => 'nullable',
            'vehiclecat_id' => 'nullable|integer|exists:vehiclecats,id',
        ]);

        $slug = Str::slug($fields['brand_name']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('vehicles-images', $request->banner);
        }

        Auth::user()->vehicles()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/vehicles')->with('success', 'Vehicle created successfully');
    }
    public function show(Vehicle $vehicle)
    {
        $otherVehicles = Vehicle::latest()->where('id', '!=', $vehicle->id)->take(4)->get();
        return view('public.vehicle-rental-show', compact('vehicle', 'otherVehicles'));
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicleCategories = Vehiclecat::all();
        return view('dashboard.vehicle-rental.edit', compact('vehicle', 'vehicleCategories'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Validate
        $fields = $request->validate([
            'brand_name' => "required|max:255|unique:vehicles,brand_name,$vehicle->id",
            'rental_price' => 'required|integer',
            'color' => 'nullable',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'policy' => 'required',
            'information' => 'nullable',
            'vehiclecat_id' => 'nullable|integer|exists:vehiclecats,id',
        ]);

        $slug = Str::slug($fields['brand_name']);

        // Upload image if file exist
        $path = $vehicle->banner ?? null;
        if ($request->hasFile('banner')) {
            if ($vehicle->banner) {
                Storage::disk('public')->delete($vehicle->banner);
            }
            $path = Storage::disk('public')->put('vehicles-images', $request->banner);
        }

        // Update the vehicle
        $vehicle->update([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/vehicles')->with('success', 'Vehicle updated successfully');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->banner) {
            Storage::disk('public')->delete($vehicle->banner);
        }

        $vehicle->delete();

        return back()->with('delete', 'Vehicle deleted successfully');
    }
}
