@extends('layouts.app_edit')

@section('content')

<div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3"> platform setting for this post</h1>
        </div>
        <div class=" col-8 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{url("toggle_platform/".$postID)}}" method="Post" class="form border p-3" enctype="multipart/form-data">
                @csrf
                        <div class="form-group">
            <label for="platform_id">platform</label></label>
            <select name="platform_id" id="platform_id" class="form-control" required>
                <option selected>select </option>
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status"></label>
            <select name="status" id="status" class="form-control" required>
                <option value="active">active</option>
                <option value="not active">not active</option>
            </select>
        </div>

       
                <div class="row col-12 my-3">
                    <input class="btn btn-primary bg-success" type="submit" value="toggle">
                </div>

            </form>

        </div>

    </div>

@endsection