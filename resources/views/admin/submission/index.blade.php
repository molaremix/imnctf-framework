@extends('masters.nav')
@push('styles')
    <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="teams" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Challenge</th>
                                <th>Team</th>
                                <th>Flag</th>
                                <th>Submit Time</th>
                                <th width="100">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($submissions as $item)
                                <tr>
                                    <td>{{$item->challenge['name']}}</td>
                                    <td>{{$item->team['name']}}</td>
                                    <td>{{$item['flag']}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                    <td>
                                        @if($item->correct())
                                            <span class="btn btn-xs btn-outline-success">Accepted</span>
                                        @else
                                            <span class="btn btn-xs btn-outline-danger">Incorrect</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Challenge</th>
                                <th>Team</th>
                                <th>Flag</th>
                                <th>Submit Time</th>
                                <th width="100">Status</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#teams').DataTable({
                "aaSorting": []
            });
        });
    </script>
@endpush