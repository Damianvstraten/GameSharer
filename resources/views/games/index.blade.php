@extends('layouts.master')
@section('style')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('content')
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
                                <td>{{$game->name}}</td>
                                <td>
                                    <div>
                                        <form>
                                            <input type="checkbox" @if($game->active = true) checked @endif  data-toggle="toggle" data-onstyle="success" name="active_state">
                                        </form>
                                    </div>
                                </td>
                                <td style="text-align: right">
                                    <div style="display: inline-block">
                                        <a class="btn btn-default" href="{{ route('games.show', $game->id) }}">View</a>
                                    </div>
                                    <div style="display: inline-block">
                                        <a class="btn btn-primary" href="{{ route('games.edit', $game->id) }}">Edit</a>
                                    </div>
                                    <div style="display: inline-block">
                                        <form action="{{route('games.destroy',$game->id)}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                            {{ method_field('DELETE') }}
                                        </form>
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
    <a class="btn btn-primary" href="{{route('games.create')}}">Creat new game</a>
@endsection

@section('script')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection