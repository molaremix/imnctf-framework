@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card text-center">
                <div class="card-header">About</div>
                <div class="card-body" style="padding-left: 10%!important;">
                    <h2 class="card-title">Welcome to {{$about['title']}}</h2>
                    <h5 class="card-title mt-5">This event will be held from {{$about['start']}}
                        to {{$about['finish']}}</h5>
                    @if($about['freeze'] > 0)
                        <h5 class="card-title">and Scoreboard will be Frozen {{$about['freeze']}} Hour(s) before the end
                            of the Game</h5>
                    @endif
                    <div class="text-left mt-5">{!!$about['description'] !!}</div>
                </div>
            </div>

        </div>
    </div>
@endsection