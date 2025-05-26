@extends('layouts.app_edit')
@section('content')
    <div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">add new platform</h1>
        </div>
        <div class=" col-8 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{route('platforms.store')}}" method="Post" class="form border p-3" enctype="multipart/form-data">
                @csrf
                <div class="row col-12 my-3">
                    <label for="title">name</label>
                    <input type="text" name="name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row col-12 my-3">
                    <label for="type">type</label>
                    <select name="type">
                        <option selected>type</option>
                        <option value="Personal Blogging Platform">Personal Blogging Platform</option>
                        <option value="Social Media Platform">Social Media Platform</option>
                        <option value="Content Platform">Content Platform</option>
                        <option value="Discussion Platform">Discussion Platform</option>
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row col-12 my-3">
                    <input class="btn btn-primary bg-success" type="submit" value="add platform">
                </div>

            </form>

        </div>

    </div>
@endsection
