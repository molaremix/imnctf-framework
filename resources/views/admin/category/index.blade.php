@extends('masters.nav')
@push('styles')
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Categories</h3>
                                    <form action="{{isset($category) ? route('admin.category.update', $category) : route('admin.category.store')}}"
                                          method="post">
                                        @csrf
                                        @isset($category)
                                            @method('put')
                                        @endisset
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group mb-1">
                                                    <input type="text" class="form-control" placeholder="New Category"
                                                           aria-label="New Category" name="name"
                                                           value="{{$category['name'] ?? old('name')}}">
                                                    <button type="submit"
                                                            class="btn btn-sm waves-effect waves-light btn-success">Save
                                                        <i class="ti-save ml-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="challenges" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th width="150">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $item)
                                                <tr>
                                                    <td>{{$item['name']}}</td>
                                                    <td>
                                                        <a href="{{route('admin.category.edit', $item)}}"
                                                           class="btn btn-xs btn-warning"><i
                                                                    class="mr-2 ti-pencil"></i>Edit</a>
                                                        <form action="{{route('admin.category.destroy', $item)}}"
                                                              method="post" style="display: inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-xs btn-danger"><i
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