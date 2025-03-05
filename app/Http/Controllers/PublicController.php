<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Vehicle;
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
        $vehicles = Vehicle::latest();

        $search = $request->search;

        if ($search) {
            $vehicles = $vehicles->where('brand_name', 'like', "%$search%");
        }

        $vehicles = $vehicles->paginate(8);

        return view('public.vehicle-rental', compact('vehicles', 'search'));
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
