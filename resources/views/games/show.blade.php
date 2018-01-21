@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-1">
        <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            @include('includes.messages.success_message', ['key_name' => 'success_created'])

            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 style="margin:0; padding-bottom: 20px; border-bottom:1px solid #ddd">{{$game->name}}</h1>
                    <div style="margin-top: 20px">
                        <p>{{ $game->description }}</p>
                    </div>
                </div>
            </div>

            @include('includes.comments');
        </div>

        <div class="side-info">
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div style="font-weight: bold; font-size: 30px" class="panel-heading text-center">Rating</div>
                    <div class="panel-body text-center" style="padding: 15px 0">
                        <h2 style="font-size: 50px; margin-top: 0;">{{$game->rating}}</h2>
                        <span style="margin-top: 20px"><span style="font-weight: bold">{{count($game->ratings)}}</span> people rated this game</span>
                        @if(Auth::check())
                            @if($game->isRatedByUser(Auth::id()) == true)
                                </div>
                                <div class=" panel-footer text-center">
                                    <p>You have already rated this game!</p>
                                </div>
                            @else
                                <div style="padding: 0 15px">
                                    <form style="margin-top: 20px" method="POST" action="{{route('ratings.store')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <span style="text-align: left">Rate this game</span>
                                            <select class="form-control" name="score">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <input type="number" value="{{$game->id}}" hidden name="game_id">
                                        <input type="submit" value="Rate" class="btn btn-primary form-control">
                                    </form>
                                </div>
                            </div>
                            @endif
                        @else
                            </div>
                            <div class="panel-footer text-center">
                                <a href="{{route('login')}}">Login to rate this game</a>
                            </div>
                        @endif
                </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="detail-list">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="font-weight: bold">Developer</td>
                                <td>{{$game->owner->name}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Genre</td>
                                <td>{{$game->category->name}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Release date:</td>
                                <td>{{$game->release_date}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @if(Auth::check() and $game->owner->id == Auth::user()->id)
            <div class="panel panel-default">
                <div class="panel-body">
                    <a style="width: 100%; margin-bottom: 10px" href="{{route('games.edit', $game->id) }}" class="btn btn-primary">Edit</a>

                    <form action="{{route('games.destroy',$game->id)}}" method="post">
                        {{ csrf_field() }}
                        <input type="submit" value="Delete" class="btn btn-danger" style="margin-right: 10px; width: 100%">
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection