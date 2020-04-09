<!-- learning part start-->
<section class="learning_part">
    <div class="container">
        <div class="row align-items-sm-center align-items-lg-stretch">
            <div class="col-md-7 col-lg-7">
                <div class="learning_img">
                    <img src="{{ Voyager::image($data->img->value) }}" alt="learning">
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="learning_member_text">
                    <h5>{{ $data->title_h5->value }}</h5>
                    <h2>{{ $data->title_h2->value }}</h2>
                    <p>{{ $data->description->value }}</p>
                    <ul>
                        <li><span class="ti-pencil-alt"></span>{{ $data->span1->value }}</li>
                        <li><span class="ti-ruler-pencil"></span>{{ $data->span2->value }}</li>
                    </ul>
                    <a href="{{ $data->btn_action->value }}" class="btn_1">{{ $data->btn_name->value }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- learning part end-->