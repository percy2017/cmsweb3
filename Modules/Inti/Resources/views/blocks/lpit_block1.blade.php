<!-- feature_part start BLOCK 1-->
<section class="feature_part">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xl-3 align-self-center">
                <div class="single_feature_text ">
                    <h2>{!! $data->title_strong->value !!}</h2>
                    <p>{{ $data->description->value }} </p>
                    <a href="{{ $data->buton_action->value }}" class="btn_1">{{ $data->buton_name->value }}</a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <span class="single_feature_icon"><i class="ti-layers"></i></span>
                        <h4>{{ $data->h4_1->value }}</h4>
                        <p>{{ $data->parrafo_1->value }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <span class="single_feature_icon"><i class="ti-new-window"></i></span>
                        <h4>{{ $data->h4_2->value }}</h4>
                  
                        <p>{{ $data->parrafo_2->value }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part single_feature_part_2">
                        <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
                        <h4>{{ $data->h4_3->value }}</h4>
                        <p>{{ $data->parrafo_3->value }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- upcoming_event part start-->