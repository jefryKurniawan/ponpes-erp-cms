<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $query = Post::with(['category']);

            // Filter by category
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $posts = $query->orderBy('published_at', 'desc')
                            ->paginate(10);

            $categories = Category::orderBy('name')->get();

            return view('admin.berita.index', compact('posts', 'categories', $request->only(['category_id', 'status'])));
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $categories = Category::orderBy('name')->get();
            return view('admin.berita.create', compact('categories'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();

        // Generate slug from title if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        $post = Post::create($validated);

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.berita.show', compact('post'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $categories = Category::orderBy('name')->get();
            return view('admin.berita.edit', compact('post', 'categories'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();

        // Update slug if title changed
        if (!empty($validated['judul']) && ($post->judul != $validated['judul'] || empty($post->slug))) {
            $validated['slug'] = Str::slug($validated['judul']);
        }

        $post->update($validated);

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil dihapus.');
    }
}