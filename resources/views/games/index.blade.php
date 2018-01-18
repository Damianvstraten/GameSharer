@extends('layouts.master')
@section('style')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        @include('includes.messages.success_message', ['key_name' => 'success_deleted'])
        <h1 class="panel-heading"> My Games</h1>
        <div class="panel">
            <div class="panel-body">
                @if(count($userGames) > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Active</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($userGames as $game)
                                <tr>
                                    <th scope="row">{{$game->id}}</th>
                                    <td><a href="{{route('games.show', $game->id)}}">{{$game->name}}</a></td>
                                    <td>
                                        <div>
                                            <form method="POST" action="{{route('games.state', $game->id)}}" class="state_form">
                                                {{ csrf_field() }}
                                                <input type="checkbox" @if($game->active == true) checked @endif  data-toggle="toggle" data-onstyle="success" name="active_state" class="active_state">
                                                <input type="submit" hidden>
                                                {{ method_field('PUT') }}
                                            </form>
                                        </div>
                                    </td>
                                    <td style="text-align: right">
                                        <div style="display: inline-block; padding-right: 10px">
                                            <a class="btn btn-default" href="{{ route('games.show', $game->id) }}">View</a>
                                        </div>
                                        <div style="display: inline-block; padding-right: 10px">
                                            <a class="btn btn-primary" href="{{ route('games.edit', $game->id) }}">Edit</a>
                                        </div>
                                        <div style="display: inline-block; padding-right: 10px">
                                            <button class="btn btn-danger" data-toggle="modal" data-target=".delete-form">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <span>You have no games yet.</span>
                @endif
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('games.create')}}">Create new game</a>
    </div>

    @if(count($userGames) > 0)
        @include('includes.delete-popup')
    @endif
@endsection

@section('script')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection