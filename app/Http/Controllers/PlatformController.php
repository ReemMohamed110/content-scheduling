<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $platforms = Platform::paginate(5);
        return view('platforms.all_platforms', ['platforms' => $platforms]);
    }
    public function toggle($postID)
    {
       $platforms = Platform::all();
        return view('platforms.platform_setting', ['platforms' => $platforms,'postID'=>$postID]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('platforms.add_platform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlatformRequest $request)
    {
        Platform::create([
            'name' => $request->name,
            'type' => $request->type,
            
        ]);
        return back()->with('success', 'platform added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function makeToggle(Request $request,$post_id)
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

    return redirect()->back()->with(['success'=>'Platform status updated successfully.']);

    }

    
}
