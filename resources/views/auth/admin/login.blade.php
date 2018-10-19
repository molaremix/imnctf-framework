@extends('masters.auth')
@section('form')
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal m-t-20" id="loginform" action="{{route('admin.check')}}"
                  method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email"
                           aria-label="Email" name="email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Password"
                           aria-label="Password" name="password" aria-describedby="basic-addon1">
                </div>

                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection