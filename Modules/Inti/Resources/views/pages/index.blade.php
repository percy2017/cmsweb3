@extends('layouts.master')

@section('content')
    <div id="app">
        <main>
            @foreach ($blocks as $item) 
            @include('vendor.blocks.'.$item->name, ['data' => json_decode($item->details)])
            @endforeach
        </main>
    </div>
@endsection