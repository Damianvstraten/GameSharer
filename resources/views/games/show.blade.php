@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-1">
        <a href="{{ URL::previous() }}" class="btn btn-default pull-left">Back</a>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 style="margin:0; padding-bottom: 20px; border-bottom:1px solid #ddd">{{$game->name}}</h1>
                    <div style="margin-top: 20px">
                        <p>{{ $game->description }}</p>
                    </div>
                </div>
            </div>

            @include('includes.comments');
        </div>

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="detail-list">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold">Developer</td>
                                    <td>{{$game->owner->name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Genre</td>
                                    <td>{{$game->category->name}}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Release date:</td>
                                    <td>{{$game->release_date}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if(Auth::check() and $game->owner->id == Auth::user()->id)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a style="width: 100%; margin-bottom: 10px" href="{{route('games.edit', $game->id) }}" class="btn btn-primary">Edit</a>
                        <button style="width: 100%" class="btn btn-danger" data-toggle="modal" data-target=".delete-form">Delete</button>

                        {{-- Delete popup--}}
                        @include('includes.delete-popup')
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ URL::asset('js/forms.js')}}"></script>
@endsection