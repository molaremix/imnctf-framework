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
                                        <h4 class="card-title"><strong> Name </strong></h4>
                                        <h5 class="card-title">Rank #2 (2400pts)</h5>
                                    </a>
                                    <hr>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="Name" aria-label="Name">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="email" class="form-control" value="Email" aria-label="Email">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="New Password" aria-label="New Password">
                                    </div>


                                    <button type="button" class="btn waves-effect waves-light btn-outline-success">
                                        Save<i class="ml-2 ti-control-forward"></i></button>
                                    <button type="button" class="btn waves-effect float-right waves-light btn-outline-warning">
                                        Cancel<i class="ml-2 ti-close"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/extra-libs/treeview/dist/bootstrap-treeview.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/treeview/dist/bootstrap-treeview-init.js')}}"></script>
@endpush