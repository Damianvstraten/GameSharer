<!-- Modal -->
<div class="modal fade delete-form" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center" class="modal-title">Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-body" style="text-align: center">
                <form action="{{route('games.destroy',$game->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="submit" value="Yes" class="btn btn-danger" style="margin-right: 10px">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px">No</button>
                    {{ method_field('DELETE') }}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>