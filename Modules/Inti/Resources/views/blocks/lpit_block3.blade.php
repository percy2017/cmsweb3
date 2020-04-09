<!-- member_counter counter start -->
<section class="member_counter">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single_member_counter">
                    <span class="counter">{{ $data->counter1->value }}</span>
                    <h4>{!! $data->title1->value !!}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_member_counter">
                    <span class="counter">{{ $data->counter2->value }}</span>
                    <h4> {!! $data->title2->value !!}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_member_counter">
                    <span class="counter">{{ $data->counter3->value }}</span>
                    <h4>{!! $data->title3->value !!}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single_member_counter">
                    <span class="counter">{{ $data->counter4->value }}</span>
                    <h4>{!! $data->title4->value !!}</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<!-- member_counter counter end -->