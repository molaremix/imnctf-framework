@extends('masters.nav')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/quill/dist/quill.snow.css')}}">
@endpush
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
                                        <h4 class="card-title"><strong> About CTF </strong></h4>
                                    </a>
                                    <hr>
                                    <form action="{{route('admin.about.store')}}" method="post" id="about">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-flag-alt-2"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Event Name"
                                                   aria-label="Name" name="title"
                                                   value="{{old('title', $about['title'])}}">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-calendar"></i></span>
                                            </div>
                                            <input type="datetime-local" class="form-control" placeholder="start"
                                                   aria-label="Name" name="start"
                                                   value="{{old('start', $about ? date("Y-m-d\TH:i", strtotime($about['finish'])) : \Carbon\Carbon::now('Asia/Jakarta')->format("Y-m-d\TH:i"))}}">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-calendar"></i></span>
                                            </div>
                                            <input type="datetime-local" class="form-control" placeholder="finish"
                                                   aria-label="Name" name="finish"
                                                   value="{{old('finish', $about ? date("Y-m-d\TH:i", strtotime($about['finish'])) : \Carbon\Carbon::now('Asia/Jakarta')->format("Y-m-d\TH:i"))}}">
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ti-alarm-clock"></i></span>
                                            </div>
                                            <input type="number" class="form-control"
                                                   placeholder="Freeze Hours Before Finish" aria-label="Freeze"
                                                   name="freeze" value="{{old('freeze', $about['freeze'])}}">
                                        </div>
                                        <h5>Event Description</h5>
                                        <div id="editor" class="mb-3" style="height: 300px;" name="lol">
                                        </div>

                                        <input type="hidden" name="description" id="description">

                                        <button type="button" class="btn waves-effect waves-light btn-outline-success"
                                                onclick="check()">
                                            Save<i class="ml-2 ti-control-forward"></i></button>
                                        <a href="{{route('admin.submission.index')}}"
                                           class="btn waves-effect float-right waves-light btn-outline-warning">
                                            Cancel<i class="ml-2 ti-close"></i></a>
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
@push('scripts')
    <script src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $(document).ready(function () {
            var myEditor = document.querySelector('#editor');
            myEditor.children[0].innerHTML = `{!! old('description', addslashes($about['description'])) !!}`
        });

        function check() {
            var myEditor = document.querySelector('#editor');
            var html = myEditor.children[0].innerHTML;

            $('#description').val(html);
            $('form#about').submit()
        }
    </script>
@endpush