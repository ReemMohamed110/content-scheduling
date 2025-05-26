<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformResource;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::paginate(5);
        return response()->json(PlatformResource::collection($platforms), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $platform = Platform::create([
            'name' => $request->name,
            'type' => $request->type,

        ]);
        return response()->json(new PlatformResource($platform), 201);
    }

    /**
     * Display the specified resource.
     */
    public function makeToggle(Request $request, $post_id)
    {


        $post = Post::find($post_id);
        if (!$post) {
            return 'Post not found.';
        }


        $platform = Platform::find($request->platform_id);
        if (!$platform) {
            return 'Platform not found.';
        }

        $post->platforms()->syncWithoutDetaching([$request->platform_id => ['status' => $request->status]]);
     return response()->json(['successful' => 'Platform status updated successfully.', new PlatformResource($platform)]);

    }
    
}
