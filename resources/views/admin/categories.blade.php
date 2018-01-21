<div class="col-md-2">
    @include('includes.messages.success_message', ['key_name' => 'category_added'])

    <div class="panel panel-default">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">{{$category->name}}
                        <span class="badge badge-primary badge-pill">{{count($category->games)}}</span>
                    </li>
                @endforeach
            </ul>

            <form method="POST" action="{{ route('store.category') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="category_name" placeholder="Name..." class="form-control">
                </div>
                <input style="width: 100%" type="submit" class="btn btn-primary" value="Add" >
            </form>
        </div>
    </div>
</div>