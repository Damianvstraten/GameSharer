@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-1">
        <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>{{$game->name}}</h1>
                    <div>
                        <p>{{$game->description}}</p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="{{route('comments.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label style="font-size: 16px">Say something about {{$game->name}}:</label>
                            <textarea style="resize: none" class="form-control" rows="5" name="body"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="number" name="game_id" hidden value="{{$game->id}}">
                            <input type="submit" class="btn btn-primary" value="Post your comment">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="detail-list">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Release date:</td>
                                <td>{{$game->release_date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        @foreach($comments as $comment)
            <ul class="list-group list-inline">
                    <li>{{$comment->id}}</li>
                    <li>Posted at: {{$comment->created_at->diffForHumans()}}</li>
                    <li>{{$comment->developer_id}} @if($comment->developer_id == $game->developer_id) (developer) @endif</li>
            </ul>
        @endforeach
    </div>
</div>
@endsection