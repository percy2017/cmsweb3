
@extends('inti::layouts.master')
@section('header')
    @include('inti::layouts.header-index')
@endsection
@section('content')
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>{{ $collection['title_h5']['value'] }}</h5>
                            <h1>{{ $collection['title_h1']['value'] }}</h1>
                            <p>{{ $collection['parrafo']['value'] }}</p>
                            <a href="{{ $collection['btn_action1']['value'] }}" class="btn_1">{{ $collection['btn_name1']['value'] }} </a>
                            <a href="{{ $collection['btn_action2']['value'] }}" class="btn_2">{{ $collection['btn_name2']['value'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    @foreach ($blocks as $item) 
        @include('inti::blocks.'.$item->name, ['data' => json_decode($item->details)])
    @endforeach

@endsection
    