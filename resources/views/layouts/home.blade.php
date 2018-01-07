@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome back, <span class="profile_name">{{ Auth::user()->name }}</span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route('games.create')}}">Create a new game</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
