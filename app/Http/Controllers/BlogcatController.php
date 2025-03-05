<?php

namespace App\Http\Controllers;

use App\Models\Blogcat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogcatController extends Controller
{
    public function index()
    {
        $blogCats = Blogcat::latest()->get();
        return view('dashboard.blogs.blog-cat', compact('blogCats'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:blogcats',
        ]);

        $slug = Str::slug($request->name);

        Blogcat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Blog category created successfully');
    }

    public function update(Request $request, Blogcat $blogcat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:blogcats',
        ]);

        $slug = Str::slug($request->name);

        $blogcat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Blog category updated successfully');
    }

    public function destroy(Blogcat $blogcat)
    {
        $blogcat->delete();
        return back()->with('success', 'Blog category deleted successfully');
    }
}
