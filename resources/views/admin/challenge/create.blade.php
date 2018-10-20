@extends('masters.nav')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/quill/dist/quill.snow.css')}}">
@endpush
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="text-dark">
                        <h4 class="card-title"><strong> Challenge </strong></h4>
                    </a>
                    <hr>
                    <form action="@yield('action', route('admin.challenge.store'))"
                          method="post" id="challenge">
                        @csrf
                        @yield('method')
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
                            <input type="text" class="form-control" placeholder="Title"
                                   aria-label="Title" name="title"
                                   value="{{$challenge['title'] ?? old('title')}}">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Category"
                                   aria-label="Title" name="category"
                                   value="{{$challenge['category'] ?? old('category')}}">
                        </div>
                        <h5>Content</h5>
                        <div id="editor" class="mb-3" style="height: 300px;" name="lol">
                        </div>

                        <input type="hidden" name="content" id="content">

                        <button type="button" class="btn waves-effect waves-light btn-outline-success"
                                onclick="check()">
                            Save<i class="ml-2 ti-control-forward"></i></button>
                        <a href="{{route('admin.challenge.index')}}"
                           class="btn waves-effect float-right waves-light btn-outline-warning">
                            Cancel<i class="ml-2 ti-close"></i></a>
                    </form>
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
            myEditor.children[0].innerHTML = "{!! $challenge['content'] ?? old('content') !!}"
        });

        function check() {
            var myEditor = document.querySelector('#editor');
            var html = myEditor.children[0].innerHTML;

            $('#content').val(html);
            $('form#challenge').submit()
        }
    </script>
@endpush