@extends('layouts.master')

@section('content')
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                @include('admin.games')
                @include('admin.users')
            </div>
            @include('admin.categories')
        </div>
@endsection