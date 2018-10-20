@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.challenge.create')}}" class="btn btn-success mb-3">Create Challenge<i
                                class="ml-2 ti-plus"></i></a>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <h4 class="card-title">Challenge</h4>
                            <div id="challenge-tree"></div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="text-dark">
                                        <h4 class="card-title"><strong id="title">No Challenge Selected</strong> <span id="pts"></span></h4>
                                    </a>
                                    <hr>
                                    <p class="card-text" id="desc"></p>
                                    {{--<div class="alert alert-success" id="hint">Hint! : This is an example top alert. You can edit
                                        what u wish.
                                    </div>--}}
                                    {{--<div class="input-group mb-5" id="attach">
                                        <a href="#" class="btn waves-effect btn-sm waves-light btn-outline-info mr-2">
                                            puppy.zip (25Kb)<i class="ml-2 ti-download"></i>
                                        </a>
                                        <a href="#" class="btn waves-effect btn-sm waves-light btn-outline-info">
                                            puppy.zip (25Kb)<i class="ml-2 ti-download"></i>
                                        </a>
                                    </div>--}}
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
    <script>

        var data;
        $.getJSON('/api/challenges',function(json){
            data = json;
            hasDone();
        });

        function hasDone() {
            $('#challenge-tree').treeview({
                expandIcon: 'ti-angle-right',
                onhoverColor: "rgba(0, 0, 0, 0.05)",
                selectedBackColor: "#03a9f3",
                collapseIcon: 'ti-angle-down',
                nodeIcon: 'fa fa-bookmark',
                data: data,
            });

            $('#challenge-tree').on('nodeSelected', function (event, data) {
                $('#pts').text(`(${data['data']['point']}pts)`);
                $('#title').text(data['data']['name']);
                $('#desc').text(data['data']['description']);
            });
        }

    </script>
    <script src="{{asset('assets/extra-libs/treeview/dist/bootstrap-treeview.min.js')}}"></script>
@endpush