<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  $query = $request->user()->posts()->with('user');
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }
       $posts = $query->latest()->paginate(10);
        
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imagePath = 'storage/'.Storage::disk('public')->put('posts', $request->file('image_url'));
        }
        $post=Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth('api')->user()->id,
            'status' => $request->status,
            'image_url' =>$imagePath,
        ]);
        $post->platforms()->attach($request->platform_id);
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $singlePost = Post::find($id);
       return response()->json(new PostResource($singlePost), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::FindOrFail($id);

        if ($request->hasFile('image_url')) {
            if ($post->image_url) {
                Storage::disk('public')->delete($post->image_url);
                $imagePath = Storage::disk('public')->put('posts', $request->file('image_url'));
            }else{
                $imagePath = Storage::disk('public')->put('posts', $request->file('image_url'));
            }
            
           
        }else{
            $imagePath=$post->image_url;
        }
        $data = [];
        if ($request->filled('title')) {
            $data['title'] = $request->title;
        }
        if ($request->filled('status')) {
            $data['status'] = $request->status;
        }
        if ($request->filled('content')) {
            $data['content'] = $request->content;
        }
        if ($request->filled('image_url')) {
            $data['image_url'] = 'storage/'.$request->image_url;
        }

        if (!empty($data)) {
            $post->update($data);


            return response()->json(['successful' => 'post  updated successfully', new PostResource($post)]);
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $post=Post::find($id);
        if ($post->image_url) {
        Storage::disk('public')->delete($post->image_url);
    }
        Post::destroy($post->id);
        return response()->json(['message' => 'post deleted'], 200);
    
    }
}
