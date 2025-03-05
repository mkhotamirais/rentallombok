<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blogcat;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
        ];
    }

    public function index()
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        $blogs = Blog::latest()->paginate(6);
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        $blogCategories = Blogcat::all();
        return view('dashboard.blogs.create', compact('blogCategories'));
    }

    public function store(Request $request)
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255|unique:blogs',
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('blogs-images', $request->banner);
        }

        Auth::user()->blogs()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/blogs')->with('success', 'Blog created successfully');
    }

    public function show(Blog $blog)
    {
        $latestBlogs = Blog::latest()->where('id', '!=', $blog->id)->take(4)->get();
        return view('public.blog-show', compact('blog', 'latestBlogs'));
    }

    public function edit(Blog $blog)
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        $blogcats = Blogcat::all();
        return view('dashboard.blogs.edit', compact('blog', 'blogcats'));
    }

    public function update(Request $request, blog $blog)
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        // Validate
        $fields = $request->validate([
            // 'title' => ['required', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'title' => "required|max:255|unique:blogs,title,$blog->id",
            'content' => 'required',
            'blogcat_id' => 'nullable|integer|exists:blogcats,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'delete_banner' => 'nullable|boolean'
        ]);

        $slug = Str::slug($fields['title']);

        // Handle image deletion
        if ($request->has('delete_banner') && $request->delete_banner) {
            if ($blog->banner) {
                Storage::disk('public')->delete($blog->banner);
            }
            $fields['banner'] = null;
        }

        // Upload new image if provided
        if ($request->hasFile('banner')) {
            if ($blog->banner) {
                Storage::disk('public')->delete($blog->banner);
            }
            $fields['banner'] = Storage::disk('public')->put('blogs-images', $request->banner);
        }

        // Update the blog
        $blog->update([...$fields, 'slug' => $slug]);

        // Redirect
        return redirect('/blogs')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        // Gate::allowIf(fn(User $user) => $user->email === 'admin@rentallombol.id');

        if ($blog->banner) {
            Storage::disk('public')->delete($blog->banner);
        }

        $blog->delete();

        return back()->with('delete', 'Blog deleted successfully');
    }
}
