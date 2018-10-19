@extends('masters.nav')
@section('content')
    <div class="row">
        <div class="col-8 offset-2">
            <a href="{{route('admin.news.create')}}" class="btn btn-success mb-3">Create News<i
                        class="ml-2 ti-plus"></i></a>
            @if(!count($news))
                <div class="card">
                    <div class="card-header">News Info</div>
                    <div class="card-body">
                        <h4 class="card-title">There is no News ATM</h4>
                        <p class="card-text">Every News will be shown here.</p>
                    </div>
                </div>
            @endif
            @foreach($news as $item)
                <div class="card">
                    <div class="card-header">
                        {{$item['title']}}
                        <div class="float-right ">
                            <form action="{{route('admin.news.destroy', $item)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('admin.news.edit', $item)}}" class="btn btn-xs btn-warning">Edit<i
                                            class="ml-2 ti-pencil"></i></a>
                                <button type="submit" class="btn btn-xs btn-danger">Delete<i class="ml-2 ti-trash"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$item['category']}}</h4>
                        <p class="card-text">{!! $item['content'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection