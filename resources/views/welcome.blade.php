@extends('layouts.app_edit')
@section('content')
    <div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">all posts</h1>
        </div>
        <table>
            @isset($posts)
                @forelse ($posts as $post)
                    <div class="row col-12">
                        <div class="card my-5">
                            <div class="card-header">
                                created at : {{ $post->created_at }}
                            </div>

                            <div class="card-header">
                                created by:{{ $post->user->name }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Str::limit($post->content, 50) }}.....</p>
                                <img class="card-image" src="{{ $post->image_url }}">
                                <p class="card-text">status : {{ $post->status }}</p>
                                @if ($post->platforms->isEmpty())
                                    
                                @else
                                    @foreach ($post->platforms as $platform)
                                       <p class="card-text">platform name : {{ $platform->name }} </p>  
                                        <p class="card-text">platform type : {{ $platform->type }} </p> 
                                    @endforeach
                                @endif
                                <a href={{ url('posts/' . $post->id) }} class="btn btn-primary">view post</a>
                                @can('delete_edit',$post)
                                 <a href="{{ url('/platform_setting/'. $post->id) }}" class="btn btn-success">Platform setting</a>
                                 <a href={{url('posts/'.$post->id.'/edit/')}} class="btn btn-primary">edit post</a>
                                <form action="{{ url('posts/' . $post->id) }} " method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" href={{ url('posts/' . $post->id) }} class="btn btn-danger">delete
                                        post</button>
                                </form> 
                                @endcan
                               
                                

                            </div>
                        </div>
                    </div>

                @empty
                    <h1>there is no posts</h1>
                @endforelse
            </table>
        @endisset


        <div>
            {{ $posts->links() }}
        </div>

    </div>
@endsection
