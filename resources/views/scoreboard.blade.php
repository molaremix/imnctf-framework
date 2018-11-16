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
                    {{--                    <h5>{{$freeze ? 'Scoreboard has ben Freeze' : 'Competition Standing '}}</h5>--}}
                </div>
                <div class="card-body">
                    <h4 class="card-title">Submission Stats</h4>
                    <div class="status m-t-30" style="height:280px; width:100%"></div>

                    <div class="row">
                        <div class="col-3 border-right">
                            <i class="fa fa-circle text-danger mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$submissions->count()}}</span>
                            <span>Flag Submitted</span>
                        </div>

                        <div class="col-3 border-right">
                            <i class="fa fa-circle text-success mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$filteredSubmission->count()}}</span> <span>Flag Captured</span>
                        </div>

                        <div class="col-3 p-l-20">
                            <i class="fa fa-flag mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{$challengesSolved}} <span
                                        class="font-12 font-light">out of</span> {{count($challenges)}}</span> <span>Challenges Solved</span>
                        </div>

                        <div class="col-3 p-l-20">
                            <i class="fa fa-hand-rock mr-2"></i>
                            <span class="mb-0 font-medium font-22">{{count($challenges) - $challengesSolved}}</span>
                            <span>Challenges Unsolved</span>
                        </div>
                    </div>
                </div>
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
                            @foreach($results as $key => $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <a href="{{route('team.stats',  $item['team'])}}"
                                           class="text-grey">{{$item['team']['name']}}</a>
                                    </td>
                                    <td>{{ceil($item['point'])}}</td>
                                </tr>
                            @endforeach
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
    <script src="{{asset('/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('/js/pages/datatable/datatable-basic.init.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script>
        $(function () {
            "use strict";

            var chart = c3.generate({
                bindto: '.status',
                data: {
                    columns: [
                        ['Flag Captured', {{$filteredSubmission->count()}}],
                        ['Flag Submitted', {{$submissions->count()}}],
                        ['Challenges Solved', {{$challengesSolved}}],
                        ['Challenges Unsolved', {{count($challenges) - $challengesSolved}}],
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
                    pattern: ['#5ac146', '#fa5838', '#7460ee', '#ffbc34']
                }
            });
        });
    </script>
@endpush