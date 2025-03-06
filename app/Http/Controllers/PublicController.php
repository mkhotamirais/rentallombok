<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Vehicle;
use App\Models\Vehiclecat;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        $blogs = Blog::latest()->take(4)->get();

        return view('welcome', compact('vehicles', 'blogs'));
    }

    public function vehicle_rental(Request $request)
    {
        // $vehicles = Vehicle::latest();
        $search = $request->search;
        $category_slug = $request->category;
        $vehiclecats = Vehiclecat::all();

        // Mulai query dengan mengutamakan kategori "lepas kunci"
        $vehicles = Vehicle::with('vehiclecat')
            ->select('vehicles.*')
            ->join('vehiclecats', 'vehicles.vehiclecat_id', '=', 'vehiclecats.id')
            ->orderByRaw("CASE WHEN vehiclecats.slug = 'lepas-kunci' THEN 0 ELSE 1 END")
            ->latest();

        if ($search) {
            $vehicles = $vehicles->where('brand_name', 'like', "%$search%");
        }

        if ($category_slug) {
            $vehicles = $vehicles->whereHas('vehiclecat', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);  // Mencocokkan slug kategori
            });
        }

        $vehicles = $vehicles->paginate(8);

        return view('public.vehicle-rental', compact('vehicles', 'search', 'vehiclecats'));
    }

    public function blog(Request $request)
    {
        $blogs = Blog::latest();

        $search = $request->search;

        if ($search) {
            $blogs = $blogs->where('title', 'like', "%$search%");
        }

        $blogs = $blogs->paginate(8);

        return view('public.blog', compact('blogs', 'search'));
    }
}
