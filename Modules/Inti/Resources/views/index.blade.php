
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

    <!--::review_part start::-->
    <section class="testimonial_part">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>tesimonials</p>
                        <h2>Happy Students</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="textimonial_iner owl-carousel">
                        <div class="testimonial_slider">
                            <div class="row">
                                <div class="col-lg-8 col-xl-4 col-sm-8 align-self-center">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-sm-4">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_1.png" alt="#">
                                    </div>
                                </div>
                                <div class="col-xl-4 d-none d-xl-block">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-xl-2 d-none d-xl-block">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_1.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_slider">
                            <div class="row">
                                <div class="col-lg-8 col-xl-4 col-sm-8 align-self-center">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-sm-4">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_2.png" alt="#">
                                    </div>
                                </div>
                                <div class="col-xl-4 d-none d-xl-block">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-xl-2 d-none d-xl-block">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_1.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial_slider">
                            <div class="row">
                                <div class="col-lg-8 col-xl-4 col-sm-8 align-self-center">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-sm-4">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_3.png" alt="#">
                                    </div>
                                </div>
                                <div class="col-xl-4 d-none d-xl-block">
                                    <div class="testimonial_slider_text">
                                        <p>Behold place was a multiply creeping creature his domin to thiren open void
                                            hath herb divided divide creepeth living shall i call beginning
                                            third sea itself set</p>
                                        <h4>Michel Hashale</h4>
                                        <h5> Sr. Web designer</h5>
                                    </div>
                                </div>
                                <div class="col-xl-2 d-none d-xl-block">
                                    <div class="testimonial_slider_img">
                                        <img src="img/testimonial_img_1.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--::blog_part end::-->

    <!--::blog_part start::-->
    <section class="blog_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>Our Blog</p>
                        <h2>Students Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_1.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Design</a>
                                <a href="blog.html">
                                    <h5 class="card-title">Dry beginning sea over tree</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_2.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Developing</a>
                                <a href="blog.html">
                                    <h5 class="card-title">All beginning air two likeness</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_3.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#" class="btn_4">Design</a>
                                <a href="blog.html">
                                    <h5 class="card-title">Form day seasons sea hand</h5>
                                </a>
                                <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::blog_part end::-->
    @endsection
    