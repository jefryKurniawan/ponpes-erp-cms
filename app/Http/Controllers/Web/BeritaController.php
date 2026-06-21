<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
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

            $category_id = $request->input('category_id');
            $status = $request->input('status');
            return view('admin.berita.index', compact('posts', 'categories', 'category_id', 'status'));
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

        // Prepare data for Post model
        $data = [
            'title' => $validated['judul'],
            'slug' => $validated['slug'],
            'content' => $validated['isi'],
            'status' => $validated['status'],
            'published_at' => $validated['published_at'],
            'category_id' => $validated['category_id'],
        ];

        // Handle featured image upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('posts', 'public');
            $data['featured_image'] = basename($path);
        }

        $post = Post::create($data);

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.berita.show', compact('post'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        \Log::debug('BeritaController@update called with id: '.$id);
        $post = Post::findOrFail($id);

        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();
        \Log::debug('Validated data: '.print_r($validated, true));

        // Prepare data for Post model
        $data = [
            'title' => $validated['judul'],
            'slug' => $validated['slug'],
            'content' => $validated['isi'],
            'status' => $validated['status'],
            'published_at' => $validated['published_at'],
            'category_id' => $validated['category_id'],
        ];

        // Update slug if title changed (regenerate slug from title)
        if (!empty($validated['judul']) && ($post->judul != $validated['judul'] || empty($post->slug))) {
            $data['slug'] = Str::slug($validated['judul']);
        }

        // Handle featured image upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('posts', 'public');
            $data['featured_image'] = basename($path);
        }

        \Log::debug('Data to update: '.print_r($data, true));
        $post->update($data);

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('admin.berita.index')
                        ->with('success', 'Berita berhasil dihapus.');
    }
}