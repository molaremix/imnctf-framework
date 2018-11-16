@extends('masters.nav')
@push('styles')
    <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <style>
        .text-grey {
            color: #6a7a8c;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>{{$team['name']}}</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Submission Stats</h4>
                    <div class="status m-t-30" style="height:280px; width:100%"></div>

                    <div class="row">
                        <div class="col-4 border-right">
                            <i class="fa fa-circle text-success mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$solved->count()}}</span> <span>Correct Flag</span>
                        </div>
                        <div class="col-4 border-right">
                            <i class="fa fa-circle text-danger mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$submissions->count() - $solved->count()}}</span> <span>Incorrect Flag</span>
                        </div>

                        <div class="col-4 p-l-20">
                            <i class="fa fa-flag mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$submissions->count()}}</span> <span>Flag Submitted</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-hover">
                            <thead>
                            <tr>
                                <th width="40">No</th>
                                <th>Challenge</th>
                                <th>Submit Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($solved->sortKeysDesc() as $key => $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td width="50%">
                                        <a href="{{route('challenge.show',  $item->challenge)}}"
                                           class="text-grey">{{$item->challenge['name']}}</a>
                                    </td>
                                    <td>{{$item->created_at->diffForHumans()}}
                                        ({{$item->created_at}})
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('/js/pages/datatable/datatable-basic.init.js')}}"></script>
    <script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script>
        $(function () {
            "use strict";

            var chart = c3.generate({
                bindto: '.status',
                data: {
                    columns: [
                        ['Correct Submission', {{$solved->count()}}],
                        ['Incorrect Submission', {{$submissions->count() - $solved->count()}}],
                        ['Flag Submitted', {{$submissions->count()}}],
                    ],

                    type: 'donut'
                },
                donut: {
                    label: {
                        show: false
                    },
                    title: "Stats",
                    width: 70,

                },

                legend: {
                    hide: true
                },
                color: {
                    pattern: ['#5ac146', '#fa5838', '#7460ee']
                }
            });
        });
    </script>
@endpush