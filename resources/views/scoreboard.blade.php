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
                        <table id="zero_config" class="table table-hover">
                            <thead>
                            <tr>
                                <th width="40">#</th>
                                <th>Team</th>
                                <th width="100">Point</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=1;  $i<100; $i++)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>LOL</td>
                                    <td>{{rand(0, 1000)}}</td>
                                </tr>
                            @endfor
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>Point</th>
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
    <script src="{{asset('/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('/assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('/js/pages/dashboards/dashboard3.js')}}"></script>
    <script src="{{asset('/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('/js/pages/datatable/datatable-basic.init.js')}}"></script>
@endpush