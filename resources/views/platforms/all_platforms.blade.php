@extends('layouts.app_edit')
@section('content')
    <div class="container my-3">
        <div class="row col-12">
            <h1 class="p-3 boarder text-center my-3">all platforms</h1>
        </div>
        <div class=" col-8 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">platform</th>
                        <th scope="col">type</th>
                        
                    </tr>
                </thead>
                <tbody>

                    @isset($platforms)
                        @forelse ($platforms as $platform)
                            <tr>
                                <th scope="row">#</th>
                                <td>{{ $platform->name }}</td>
                                <td>{{ $platform->type }}</td>
                                
                            </tr>
                        @empty

                            <td>there is no platforms</td>
                        @endforelse
                    @endisset



                </tbody>
            </table>

        </div>

    </div>
@endsection
