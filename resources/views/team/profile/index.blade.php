@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="text-dark">
                                        <h4 class="card-title"><strong> {{$team['name']}} </strong></h4>
                                        <h5 class="card-title">Rank #2 (2400pts)</h5>
                                    </a>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="email" class="form-control" readonly value="{{$team['email']}}" aria-label="Email">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Current Password" aria-label="Current Password">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="New Password" aria-label="New Password">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password">
                                    </div>


                                    <button type="button" class="btn waves-effect waves-light btn-outline-success">
                                        Save<i class="ml-2 ti-control-forward"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection