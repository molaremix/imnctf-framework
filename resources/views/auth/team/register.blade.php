@extends('masters.auth')
@section('title', 'Register Team')
@section('form')
    @php($about = \App\Models\About::orderBy('id', 'DESC')->first())
    <div class="row">
        <div class="col-12">
            <h3 class="card-title">Create Team</h3>
            <hr>
            <form action="@yield('action', route('team.register'))" method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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


                <button class="btn waves-effect waves-light btn-outline-info">
                    Register<i class="ml-2 icon-paper-plane"></i></button>
            </form>
        </div>
    </div>
@endsection