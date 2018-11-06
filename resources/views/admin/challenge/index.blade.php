@extends('masters.nav')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('admin.challenge.create')}}" class="btn btn-success mb-3">Create Challenge<i
                                class="ml-2 ti-plus"></i></a>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="challenges" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Point</th>
                                                <th>Limit</th>
                                                <th>Flag</th>
                                                <th>Solve</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($challenges as $item)
                                                <tr>
                                                    <td>{{$item['name']}}</td>
                                                    <td>{{$item->category['name']}}</td>
                                                    <td>{{$item['point']}}</td>
                                                    <td>{{$item['submission_limit'] == 0 ? '~' : $item['submission_limit']}}</td>
                                                    <td>{{$item['flag']}}</td>
                                                    <td>{{$item->solve()}}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-xs btn-warning"><i class="mr-2 ti-pencil"></i>Edit</a>
                                                        <a href="#" class="btn btn-xs btn-danger"><i class="mr-2 ti-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Point</th>
                                                <th>Limit</th>
                                                <th>Flag</th>
                                                <th>Solve</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
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
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#challenges').DataTable();
        });
    </script>
@endpush