<div class="comment-section">
    <div style="margin: 0; border-bottom: 0;  border-bottom-right-radius: 0; border-bottom-left-radius: 0" class="panel panel-default">
        <h2 style="margin-bottom: 0; padding: 0 0 20px 15px">Comments</h2>
    </div>
    @foreach($game->comments as $comment)
        <div class="main-comment">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$comment->owner->name}}
                    @if($game->developer_id == $comment->owner->id)
                        (<b>owner</b>)
                    @endif
                    <span class="pull-right">{{$comment->created_at->diffForHumans()}} </span></div>
                <div class="panel-body">
                    {{$comment->body}}
                </div>
                @if(Auth::check())
                    <div class="panel-footer">
                        <a style="cursor: pointer" class="reply-opener">Reply</a>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="sub-comment collapse" data-toggle="false">
                    <div class="col-md-10 col-md-offset-2">
                        <form method="POST" action="{{route('subcomments.store')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea style="resize: none" class="form-control" rows="3" name="body"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="number" name="game_id" hidden value="{{$game->id}}">
                                <input type="number" name="main_comment_id" hidden value="{{$comment->id}}">
                                <input type="submit" class="btn btn-primary" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="subcomments-container">
                @foreach($comment->subcomments as $subcomment)
                    <div class="row">
                        <div class="col-md-10 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{$subcomment->owner->name}}
                                    @if($game->developer_id == $subcomment->owner->id)
                                        (<b>owner</b>)
                                    @endif
                                    <span class="pull-right">{{$subcomment->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="panel-body">
                                    {{$subcomment->body}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<div class="panel panel-default">
    <div class="panel-body">
        @if(Auth::check())
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
        @else
            <div style="margin: 5px;">
               <a style="margin-right: 10px" class="btn btn-primary" href="{{route('login')}}">Login to join the discussion</a>
               <a style="margin-left: 10px" class="btn btn-primary" href="{{route('register')}}">No account, join here!</a>
            </div>
        @endif
    </div>
</div>