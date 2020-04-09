@extends('layouts.master')
@section('content')
    @foreach ($blocks as $item) 
        @include('vendor.blocks.'.$item->name, ['data' => json_decode($item->details)])
    @endforeach
@endsection