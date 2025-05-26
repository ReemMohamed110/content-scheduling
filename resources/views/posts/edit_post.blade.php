@extends('layouts.app_edit')
@section('content')
    <div class="container">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">edit post</h1>
        </div>
        <div class=" col-8 mx-auto">

            <form action={{ url('posts/' . $post->id) }} method="Post" class="form border p-3" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="row col-12 my-3">
                    <label for="title">title</label>
                    <input type="text" name="title"value={{ $post->title }}>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="content">content</label>
                    <input type="text" name="content"value="{{ $post->content }}">
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row col-12 my-3">
                    <label for="status">status</label>
                    <select name="status" value={{ $post->status }}>
                        <option value="draft">draft</option>
                        <option value="scheduled">scheduled</option>
                        <option value="published">published</option>
                    </select>
                    @error('status')
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
                    <input class="btn btn-primary bg-success" type="submit" value="update post">
                </div>

            </form>

        </div>

    </div>
@endsection
