<?php

namespace App\Http\Controllers;

use App\Models\Vehiclecat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VehiclecatController extends Controller
{
    public function index()
    {
        $vehiclecats = Vehiclecat::latest()->get();
        return view('dashboard.vehicle-rental.vehicle-rental-cat', compact('vehiclecats'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:vehiclecats',
        ]);

        $slug = Str::slug($request->name);

        Vehiclecat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Vehicle category created successfully');
    }

    public function update(Request $request, Vehiclecat $vehiclecat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:vehiclecats',
        ]);

        $slug = Str::slug($request->name);

        $vehiclecat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Vehicle category updated successfully');
    }

    public function destroy(Vehiclecat $vehiclecat)
    {
        $vehiclecat->delete();
        return back()->with('success', 'Vehicle category deleted successfully');
    }
}
