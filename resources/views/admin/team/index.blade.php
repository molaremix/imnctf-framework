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
                    <a href="{{route('admin.team.create')}}" class="btn btn-success mb-3">Create Team<i
                                class="ml-2 ti-plus"></i></a>
                    <div class="table-responsive">
                        <table id="teams" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>Registration</th>
                                <th width="100">Status</th>
                                <th width="200">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $item)
                                <tr>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['email']}}</td>
                                    <td>{{$item->when()}}</td>
                                    <td>@if(!$item['verified'])
                                            <form action="{{route('admin.team.verify', $item)}}" class="d-inline"
                                                  method="post">
                                                @csrf
                                                <button class="btn btn-success btn-xs"><i class="mr-2 ti-check"></i>Set Verify
                                                </button>
                                            </form>
                                        @else
                                            Verified
                                        @endif</td>
                                    <td>
                                        <a href="{{route('admin.team.edit', $item)}}" class="btn btn-xs btn-warning"><i
                                                    class="mr-2 ti-pencil"></i>Edit</a>
                                        <form action="{{route('admin.team.destroy', $item)}}" class="d-inline"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-xs"><i class="mr-2 ti-trash"></i>Delete
                                            </button>
                                        </form>
                                        <form action="{{route('admin.team.hide', $item)}}" class="d-inline"
                                              method="post">
                                            @csrf
                                            <button class="btn btn-primary btn-xs"><i
                                                        class="mr-2 ti-close"></i>{{$item['baned'] ? 'Unban' : 'Ban'}}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Team</th>
                                <th>Point</th>
                                <th>Action</th>
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