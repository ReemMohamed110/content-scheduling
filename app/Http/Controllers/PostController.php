<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Platform;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'platforms')->latest()->paginate(10);
        return view('welcome', ['posts' => $posts]);
    }

    public function indexDashboard()
    {
        $posts = Post::with('user', 'platforms')->latest()->paginate(10);
        return view('posts.all_posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platforms = Platform::all();
        return view('posts.add_post', ['platforms' => $platforms]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = Storage::disk('public')->put('posts', $request->file('image_url'));
        }
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'image_url' => 'storage/' . $imagePath,
        ]);
        $post->platforms()->attach($request->platform_id);
        return back()->with('success', 'post added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $singlePost = Post::find($id);
        return view('posts.single_post', ['singlePost' => $singlePost]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::FindOrFail($id);
        return view('posts.edit_post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::FindOrFail($id);

        if ($request->hasFile('image_url')) {
            if ($post->image_url) {
                Storage::disk('public')->delete($post->image_url);
                $imagePath = Storage::disk('public')->put('posts', $request->file('image_url'));
            } else {
                $imagePath = Storage::disk('public')->put('posts', $request->file('image_url'));
            }
        } else {
            $imagePath = $post->image_url;
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'image_url' => 'storage/' . $imagePath,
        ]);
        return redirect()->route('welcome')->with('update', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }
        Post::destroy($post->id);
        return back()->with('success', 'post deleted successfully');
    }
}
