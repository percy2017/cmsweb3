@extends('inti::layouts.app')
@section('content')
        @foreach ($blocks as $item) 
            @include('inti::blocks.pages.'.$item->name, ['data' => json_decode($item->details)])
        @endforeach
@endsection