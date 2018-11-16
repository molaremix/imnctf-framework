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
                                        <table id="challenges" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th width="75">Name</th>
                                                <th width="75">Category</th>
                                                <th width="60">Point</th>
                                                <th width="25">Limit</th>
                                                <th>Flag</th>
                                                <th width="30">Solve</th>
                                                <th width="175">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($challenges as $item)
                                                <tr>
                                                    <td>{{$item['name']}}</td>
                                                    <td>{{$item->category['name']}}</td>
                                                    <td>{{$item->pts()}}-{{$item['point']}}</td>
                                                    <td>{{$item['submission_limit'] == -1 ? '~' : $item['submission_limit']}}</td>
                                                    <td title="{{$item['flag']}}">{{strlen($item['flag']) > 30 ? substr($item['flag'],0,30)."..." : $item['flag']}}</td>
                                                    <td>{{count($item->solve())}}</td>
                                                    <td>
                                                        <a href="{{route('admin.challenge.edit', $item)}}"
                                                           class="btn btn-xs btn-warning"><i class="mr-2 ti-pencil"></i>Edit</a>
                                                        <form action="{{route('admin.challenge.hide', $item)}}"
                                                              method="post" class="d-inline">
                                                            @csrf
                                                            <button class="btn btn-xs btn-primary"><i
                                                                        class="mr-2 ti-eye"></i>{{$item['is_visible'] ? 'Hide' : 'Show'}}
                                                            </button>
                                                        </form>
                                                        <form action="{{route('admin.challenge.destroy', $item)}}"
                                                              method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-xs btn-danger"><i
                                                                        class="mr-2 ti-trash"></i>Delete
                                                            </button>
                                                        </form>
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
            $('#challenges').DataTable({
                "aaSorting": []
            });
        });
    </script>
@endpush