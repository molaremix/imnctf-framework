@extends('admin.challenge.create')
@section('action', route('admin.challenge.update', $challenge))
@section('method')
    @method('put')
@endsection
@section('delete')
    @foreach($challenge['attachment'] as $item)
        <form action="{{route('admin.attachment.destroy', $item)}}" id="destroy-{{$item['id']}}"
              method="post" class="d-none">
            @csrf
            @method('delete')
        </form>
    @endforeach
@endsection
@section('attachment')
    @foreach($challenge['attachment'] as $item)
        <div class="input-group mb-2" id="attach">
            <a href="{{route('download', $item)}}"
               class="btn waves-effect btn-sm waves-light btn-outline-info mr-2">
                {{$item['name']}} ({{$item->size()}}kb)<i
                        class="ml-2 ti-download"></i>
            </a>
            <button type="button" onclick="submit_{{$item['id']}}()"
                    class="btn waves-effect btn-sm waves-light btn-danger mr-2">
                delete<i class="ml-2 ti-trash"></i>
            </button>
            <script>
                function submit_{{$item['id']}}() {
                    $('form#destroy-{{$item['id']}}').submit();
                }
            </script>
        </div>
    @endforeach
@endsection