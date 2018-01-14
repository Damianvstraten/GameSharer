@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="get" action="{{ route('search') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" id="search" name="q" class="form-control" placeholder="Search..." style="width: auto; display: inline-block">
                            <select name="filter" id="filter" class="form-control" style="display: inline-block; width: auto">
                                <option value="new">New</option>
                                <option value="upcomming">Upcomming</option>
                                <option value="popular">Popular</option>
                            </select>
                            <input type="submit" class="btn btn-primary" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                @if(Auth::check())
                    <div class="panel-heading">Welcome back, <span class="profile_name">{{ Auth::user()->name }}</span></div>
                @endif

                <div class="panel-body">
                    @if(isset($games))
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Release Date</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $game)
                                <tr>
                                    <th scope="row">{{$game->id}}</th>
                                    <td><a href="{{route('games.show', $game->id)}}">{{$game->name}}</a></td>
                                    <td> {{$game->release_date}}
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <label>Genres</label>
                    @foreach($categories as $category)
                        <div class="category">
                            <input id="category" type="checkbox">
                            <label for="category">{{$category->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
