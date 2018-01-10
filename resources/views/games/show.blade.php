@extends('layouts.master')

@section('content')
    <div class="col-md-8 col-md-offset-1">
        <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
    </div>
    <h2 class="lead">Detail page</h2>
    <h1>{{$game->name}}</h1>
    <div>
        <p>{{$game->description}}</p>
    </div>
    <ul class="list-group">
        <li><span>Release date: </span>{{$game->release_date}}</li>
    </ul>
@endsection