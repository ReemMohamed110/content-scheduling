@extends('layouts.app_edit')
@section('content')
    <div class="container">
        
        <div class="row">

            <div class="row col-12">

                <h1 class="p-3 boarder text-center my-3">all posts</h1>
            </div>
            @if (session('success'))
                <div class="alert alert-danger">{{ session('success') }}</div>
            @endif
            @if (session('update'))
                <div class="alert alert-success">{{ session('update') }}</div>
            @endif
            <div class="col-12 ">
                <div class="table-responsive">
                    <table class="table table-bordered w-150">
                    <thead>
                        <th>#</th>
                        <th>tittle</th>
                        <th>content</th>
                        <th>user name</th>
                        <th>action</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>#</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->content}}</td>
                                <td>{{$post->user->name}}</td>

                                <td>
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
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div>
            {{$posts->links()}}
        </div>
    </div>
@endsection
