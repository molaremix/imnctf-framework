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
                                    <h3 class="card-title">Create Team</h3>
                                    <hr>
                                    <form action="@yield('action', route('admin.team.store'))" method="post">
                                        @csrf
                                        @yield('method')
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-face-smile"></i></span>
                                            </div>
                                            <input type="text" placeholder="Name" class="form-control" name="name" value="{{$team['name'] ?? old('name')}}">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-email"></i></span>
                                            </div>
                                            <input type="email" placeholder="Email" class="form-control" name="email" value="{{$team['email'] ?? old('email')}}"
                                                   aria-label="Email">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-key"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-key"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirmation_password">
                                        </div>


                                        <button class="btn waves-effect waves-light btn-outline-success">
                                            Save<i class="ml-2 ti-control-forward"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection