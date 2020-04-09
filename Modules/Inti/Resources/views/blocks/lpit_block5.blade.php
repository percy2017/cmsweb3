<!-- learning part start-->
<section class="advance_feature learning_part">
    <div class="container">
        <div class="row align-items-sm-center align-items-xl-stretch">
            <div class="col-md-6 col-lg-6">
                <div class="learning_member_text">
                    <h5>{{ $data->title_h5->value }}</h5>
                    <h2>{{ $data->title_h2->value }}</h2>
                    <p>{{ $data->parrafo->value }}</p>
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <div class="learning_member_text_iner">
                                <span class="ti-pencil-alt"></span>
                                <h4>{{ $data->title_h4->value }}</h4>
                                <p>{{ $data->parrafo_2->value }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <div class="learning_member_text_iner">
                                <span class="ti-stamp"></span>
                                <h4>{{ $data->title_h4_1->value }}</h4>
                                <p>{{ $data->parrafo_3->value }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="learning_img">
                    <img src="{{ voyager::Image($data->imagen->value) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- learning part end-->