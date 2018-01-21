@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div style="display: flex">
                        <div class="search-form" style="flex: 100%">
                            <form method="get" action="{{ route('home') }}">
                                {{ csrf_field() }}
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search..." style="width: auto; display: inline-block; margin-right: 10px" value="{{ old('search') }}">
                                <select name="filter" class="form-control" style="display: inline-block; width: auto; margin-right: 10px">
                                    <option style="background-color: #ccd0d2;" disabled selected>Filter by</option>
                                    <option {{ old('filter') == 'new' ? 'selected' : '' }} value="new">New</option>
                                    <option {{ old('filter') == 'upcoming' ? 'selected' : '' }} value="upcoming">Upcomming</option>
                                    <option {{ old('filter') == 'rating' ? 'selected' : '' }}  value="rating">Rating</option>
                                </select>
                                <select name="category" class="form-control" style="display: inline-block; width: auto; margin-right: 10px">
                                    <option style="background-color: #ccd0d2" disabled selected>Category</option>
                                    @foreach($categories as $category)
                                        <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary" value="Search">
                            </form>
                        </div>
                        <div class="reset-button">
                            <a href="{{route('home')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.search_results')
    </div>
</div>
@endsection
