@extends('layouts.app_edit')
@section('content')
    <div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">add new post</h1>
        </div>
        <div class=" col-8 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{route('posts.store')}}" method="Post" class="form border p-3" enctype="multipart/form-data">
                @csrf
                <div class="row col-12 my-3">
                    <label for="title">title</label>
                    <input type="text" name="title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="content">content</label>
                    <input type="text" name="content">
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="status">status</label>
                    <select name="status">
                        <option value="draft">draft</option>
                        <option value="scheduled">scheduled</option>
                        <option value="published">published</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="status">platform</label>
                    <select name="platform_id">
                        @foreach ($platforms as $platform )
                             <option value="{{$platform->id}}">{{$platform->name}} _{{$platform->type}}</option>
                        @endforeach
                       
                        
                    </select>
                    @error('platform_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="image_url">image</label>
                    <input type="file" name="image_url">
                    @error('image_url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <input class="btn btn-primary bg-success" type="submit" value="create post">
                </div>

            </form>

        </div>

    </div>
@endsection
