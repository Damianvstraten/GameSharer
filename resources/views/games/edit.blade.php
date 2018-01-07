@extends('layouts.master')

@section('content')
    <div class="col-md-8 col-md-offset-1">
        <a href="{{route('games.index')}}" class="btn btn-default pull-left">Back</a>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <h2>Edit</h2>
        <form method="POST" action="{{route('games.update', $game->id)}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" placeholder="Enter title" name="name" value="{{$game->name}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="10" placeholder="Add some information to your game" name="description">{{$game->description}}
                </textarea>
            </div>

            <div class="form-group">
                <label for="release_date">Release date</label>
                <input type="date" class=form-control id="release_date" name="release_date" value="{{$game->release_date}}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            {{ method_field('PUT') }}
        </form>
    </div>
@endsection