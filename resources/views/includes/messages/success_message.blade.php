@if(Session::has($key_name))
    <div class="alert alert-success">
        {{Session::get($key_name)}}
    </div>
@endif