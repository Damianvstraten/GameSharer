<div class="col-md-2">
    <div class="rating">
        <div class="panel panel-default">
            <div style="font-weight: bold; font-size: 30px" class="panel-heading text-center">Rating</div>
            <div class="panel-body text-center" style="padding: 15px 0">
            <h2 style="font-size: 50px; margin-top: 0">{{$game->getRating() }}</h2>
            <span><span style="font-weight: bold">{{count($game->ratings)}}</span> people rated this game</span>

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
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <input type="number" value="{{$game->id}}" hidden name="game_id">
                            <input type="submit" value="Rate" class="btn btn-primary form-control">
                        </form>
                    </div>
                @endif
            @else
                </div>
                <div class="panel-footer text-center">
                    <a href="{{route('login')}}">Login to rate this game</a>
                </div>
        @endif
        @include('includes.messages.success_message', ['key_name' => 'success_rating'])
    </div>
</div>