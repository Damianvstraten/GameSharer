<div class="panel panel-default">
    <div class="panel-heading">
        Games
    </div>
    <div class="panel-body">
        @if(isset($games))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Developer</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($games as $game)
                    <tr>
                        <td>{{$game->id}}</td>
                        <td><a href="{{route('games.show', $game->id)}}">{{$game->name}}</a></td>
                        <td>{{$game->owner->name}}</td>
                        <td>
                            <form method="POST" action="{{route('games.state', $game->id)}}" class="state_form">
                                {{ csrf_field() }}
                                <input type="checkbox" @if($game->active == true) checked @endif  data-toggle="toggle" data-onstyle="success" name="active_state" class="active_state">
                                <input type="submit" hidden>
                                {{ method_field('PUT') }}
                            </form>
                        </td>
                        <td>
                            <form action="{{route('games.destroy',$game->id)}}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" value="Delete" class="btn btn-danger" style="margin-right: 10px">
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else

        @endif
    </div>
</div>
