<!--::review_part start::-->
<section class="special_cource padding_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="section_tittle text-center">
                    <p>{{ $data->title_p->value }}</p>           
                    <h2>{{ $data->title_h2->value }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="{{ voyager::Image($data->imagen_1->value) }}" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="{{ $data->btn_action_1->value }}" class="btn_4">{{ $data->btn_1->value }}</a>
                        <h4>{{ $data->price_h4_1->value }}</h4>
                        <a href="{{ $data->link_action_1->value }}"><h3>{{ $data->link_1->value }}</h3></a>
                        <p>{{ $data->description_1->value }}</p>
                        <div class="author_info">
                            <div class="author_img">
                                <img src="{{ voyager::Image($data->imagen_autor_1->value) }}" alt="">
                                <div class="author_info_text">
                                    <p>{{ $data->title_p_1->value }}</p>
                                    <h5><a href="#">{{ $data->title_h5_1->value }}</a></h5>
                                </div>
                            </div>
                            <div class="author_rating">
                                <div class="rating">
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.sv') }}g" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg ')}}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/star.svg') }}" alt=""></a>
                                </div>
                                <p>3.8 Ratings</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="{{ voyager::Image($data->imagen_2->value) }}" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="{{ $data->btn_action_2->value }}" class="btn_4">{{ $data->btn_2->value }}</a>
                        <h4>{{ $data->price_h4_2->value }}</h4>
                        <a href="{{ $data->link_action_2->value }}"> <h3>{{ $data->link_2->value }}</h3></a>
                        <p>{{ $data->description_2->value }}</p>
                        <div class="author_info">
                            <div class="author_img">
                                <img src="{{ voyager::Image($data->imagen_autor_2->value) }}" alt="">
                                <div class="author_info_text">
                                    <p>{{ $data->title_p_2->value }}</p>
                                    <h5><a href="#">{{ $data->title_h5_2->value }}</a></h5>
                                </div>
                            </div>
                            <div class="author_rating">
                                <div class="rating">
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.sv') }}g" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg ')}}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/star.svg') }}" alt=""></a>
                                </div>
                                <p>3.8 Ratings</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="single_special_cource">
                    <img src="{{ voyager::Image($data->imagen_3->value) }}" class="special_img" alt="">
                    <div class="special_cource_text">
                        <a href="{{ $data->btn_action_3->value }}" class="btn_4">{{ $data->btn_3->value }}</a>
                        <h4>{{ $data->price_h4_3->value }}</h4>
                        <a href="{{ $data->link_action_3->value }}">  <h3>{{ $data->link_3->value }}</h3> </a> 
                        <p>{{ $data->description_3->value }}</p>
                        <div class="author_info">
                            <div class="author_img">
                                <img src="{{ voyager::Image($data->imagen_autor_3->value) }}" alt="">
                                <div class="author_info_text">
                                    <p>{{ $data->title_p_3->value }}</p>
                                    <h5><a href="#">{{ $data->title_h5_3->value }}</a></h5>
                                </div>
                            </div>
                            <div class="author_rating">
                                <div class="rating">
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.sv') }}g" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/color_star.svg ')}}" alt=""></a>
                                    <a href="#"><img src="{{ asset('vendor/inti/img/icon/star.svg') }}" alt=""></a>
                                </div>
                                <p>3.8 Ratings</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--::blog_part end::-->