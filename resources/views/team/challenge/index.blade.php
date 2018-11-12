@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if(!$started)
                            <div class="col-12 text-center">
                                <h5>The Competition is Not Started yet</h5>
                            </div>
                        @elseif($finished)
                            <div class="col-12 text-center">
                                <h5>The Competition has over. Thank You for Playing</h5>
                            </div>
                        @else
                            <div class="col-md-4 col-12">
                                <h4 class="card-title">Challenge</h4>
                                <div id="challenge-tree"></div>
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="#" class="text-dark">
                                            <h4 class="card-title"><strong
                                                        id="title">{{$challenge['name'] ?? 'No Challenge Selected'}}</strong>
                                                <span
                                                        id="pts"></span></h4>
                                        </a>
                                        <hr>
                                        @isset($challenge)
                                            @if($challenge->remain() >= 0)
                                                <div class="alert alert-info">You Have {{$challenge->remain()}} tries
                                                    remain
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                                aria-hidden="true">×</span></button>
                                                </div>
                                            @endif
                                            <p class="card-text" id="desc">{!! $challenge['description'] !!}</p>

                                            @if(count($hints) > 0)

                                                <div class="alert alert-success" id="hint">Hint! :
                                                    <ul>
                                                        @foreach($hints as $item)
                                                            <li>{{$item['description']}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endisset
                                            @foreach($challenge['attachment'] as $item)
                                                <span class="font-10">md5sum ({{$item->checksum()}})</span>
                                                <div class="input-group mb-2" id="attach">
                                                    <a href="{{route('download', $item)}}"
                                                       class="btn waves-effect btn-sm waves-light btn-outline-info mr-2">
                                                        {{$item['name']}} ({{$item->size()}}kb)<i
                                                                class="ml-2 ti-download"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                            <form action="{{route('submission.store')}}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$challenge['id']}}" name="challenge_id">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ti-flag-alt-2"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Flag"
                                                           aria-label="Flag" name="flag">
                                                </div>
                                                <button class="btn waves-effect waves-light btn-outline-success">
                                                    Submit<i class="ml-2 ti-control-forward"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        var data;
        $.getJSON('{{route('challenges')}}', function (json) {
            data = json;
            hasDone();
        });

        function hasDone() {
            $('#challenge-tree').treeview({
                expandIcon: 'ti-angle-right',
                onhoverColor: "rgba(0, 0, 0, 0.05)",
                selectedBackColor: "#03a9f3",
                collapseIcon: 'ti-angle-down',
                nodeIcon: 'ti-flag',
                data: data,
                enableLinks: true
            });
            $('#challenge-tree').treeview('collapseAll', {silent: true});
        }
    </script>
    <script src="{{asset('assets/extra-libs/treeview/dist/bootstrap-treeview.min.js')}}"></script>

@endpush