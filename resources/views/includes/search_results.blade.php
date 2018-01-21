<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        @if(Auth::check())
            <div class="panel-heading">Welcome back, <span class="profile_name">{{ Auth::user()->name }}</span></div>
        @endif

        <div class="panel-body">
            @if(isset($games))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Release Date</th>
                        <th scope="col">Rating</th>
                        <th scope="col"></th>
                        <th scope="col">Developer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td><a href="{{route('games.show', $game->id)}}">{{$game->name}}</a></td>
                            <td>{{$game->category->name}}</td>
                            <td>{{date('d-m-Y', strtotime($game->release_date))}}</td>
                            <td style="font-weight: bold; font-size: 15px">{{$game->rating == 0 ? 'No rating' : $game->rating}}</td>
                            <td><span class="badge badge-primary badge-pill">{{count($game->ratings) }} reviews</span></td>
                            <td>{{$game->owner->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>