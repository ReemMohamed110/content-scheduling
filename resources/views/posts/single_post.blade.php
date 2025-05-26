@extends('layouts.app_edit')
@section('content')
    <div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">single post</h1>
        </div>

        <div class="row col-12">
            <div class="card">
                <div class="card-header">
                    {{ $singlePost->created_at }}
                </div>
                <div class="card-header">
                    posted by : {{ $singlePost->user->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $singlePost->title }}</h5>
                    <p class="card-text">{{ $singlePost->content }}</p>
                    @if ($singlePost->image_url)
                        <img class="card-image" src="{{ asset($singlePost->image_url) }}">
                    @endif

                    <p class="card-text">status : {{ $singlePost->status }}</p>
                    @can('delete_edit', $singlePost)
                        <a href="{{ url('/platform_setting/' . $singlePost->id) }}" class="btn btn-success">Platform setting</a>
                        <a href={{ url('posts/' . $singlePost->id . '/edit/') }} class="btn btn-primary">edit post</a>
                        <form action="{{ url('posts/' . $singlePost->id) }} " method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" href={{ url('posts/' . $singlePost->id) }} class="btn btn-danger">delete
                                post</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>

    </div>
@endsection
