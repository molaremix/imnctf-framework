@extends('admin.news.create')
@section('method')
    @method('put')
@endsection
@section('action', route('admin.news.update', $news))