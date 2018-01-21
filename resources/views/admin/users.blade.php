<div class="panel panel-default">
    <div class="panel-heading">
        Users
    </div>
    <div class="panel-body">
        @if(isset($users))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Total Games</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form method="POST" action="{{route('user.update', $user->id)}}" class="state_form">
                                {{ csrf_field() }}
                                <input type="checkbox" @if($user->isAdmin()) checked @endif  data-toggle="toggle" data-onstyle="success" name="active_state" class="active_state">
                                <input type="submit" hidden>
                                {{ method_field('PUT') }}
                            </form>
                        </td>
                        <td><span style="font-size: 15px" class="badge badge-primary badge-pill">{{count($user->games)}}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <span>There are no users</span>
        @endif
    </div>
</div>

{{-- Pagination --}}
{{  $users->links() }}