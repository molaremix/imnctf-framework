@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <h4 class="card-title">Challenge</h4>
                            <div id="challenge-tree"></div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="text-dark">
                                        <h4 class="card-title"><strong>Opening Challenge</strong> (25pts)</h4>
                                    </a>
                                    <hr>
                                    <p class="card-text">
                                        Here is a zip file full of just the finest little puppers. Can you find the
                                        hidden flag in the pile of pupper pictures?
                                    </p>
                                    <div class="alert alert-success">Hint!  : This is an example top alert. You can edit what u wish. </div>
                                    <div class="input-group mb-5">
                                        <a href="#" class="btn waves-effect btn-sm waves-light btn-outline-info mr-2">
                                            puppy.zip (25Kb)<i class="ml-2 ti-download"></i>
                                        </a>
                                        <a href="#" class="btn waves-effect btn-sm waves-light btn-outline-info">
                                            puppy.zip (25Kb)<i class="ml-2 ti-download"></i>
                                        </a>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ti-flag-alt-2"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Flag" aria-label="Flag">
                                    </div>
                                    <button type="button" class="btn waves-effect waves-light btn-outline-success">
                                        Submit<i class="ml-2 ti-control-forward"></i></button>
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