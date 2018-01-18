@if($errors->has($field_name))
    <div style="padding: 5px; margin-top: 10px" class="alert alert-danger">
        <span>{{ $errors->first($field_name) }}</span>
    </div>
@endif