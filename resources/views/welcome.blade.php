@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card text-center">
                <div class="card-header">About</div>
                <div class="card-body" style="padding-left: 10%!important;">
                    <h1 class="card-title">Welcome to {{$about['title']}}</h1>
                    <h4 class="card-title mt-5">This event will be held from {{$about['start']}}
                        to {{$about['finish']}}</h4>
                    @if($about['freeze'] > 0)
                        <h4 class="card-title">and Scoreboard will be Frozen {{$about['freeze']}} Hour(s) before the end of the
                            Game</h4>
                    @endif
                    <div class="text-left">{!!$about['description'] !!}</div>
                </div>
            </div>

        </div>
    </div>
@endsection