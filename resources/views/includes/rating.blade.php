<div class="panel panel-default">
    <div style="font-weight: bold; font-size: 30px" class="panel-heading text-center">Rating</div>
    <div class="panel-body text-center" style="padding: 15px 0">
        <h2 style="font-size: 50px; margin-top: 0;">{{$game->rating}}</h2>
    <span style="margin-top: 20px"><span style="font-weight: bold">{{count($game->ratings)}}</span> people rated this game</span>

    @if(Auth::check())
        @if($game->isRatedByUser(Auth::id()) == true)
        </div>
        <div class="panel-footer text-center">
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
        @endif
    @else
        <div class="panel-footer text-center">
            <a href="{{route('login')}}">Login to rate this game</a>
        </div>
    @endif
</div>