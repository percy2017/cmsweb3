<div class="container">
 <hr>
      <!--Section: Testimonials v.4-->
      <section class="text-center pb-4">

        <!--Section heading-->
        <h1 class="mb-5 my-5 pt-5 text-center dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong
            class="font-weight-bold">{{ $data->title_strong->value }}</strong> {{ $data->title_default->value }}</h1>

        <div class="row">

          <!--Carousel Wrapper-->
          <div id="multi-item-example" class="carousel testimonial-carousel slide carousel-multi-item mb-5"
            data-ride="carousel">

            <!--Controls-->
            <div class="controls-top">
              <a class="btn-floating btn-blue btn-sm" href="#multi-item-example" data-slide="prev"><i
                  class="fas fa-chevron-left"></i></a>
              <a class="btn-floating btn-blue btn-sm" href="#multi-item-example" data-slide="next"><i
                  class="fas fa-chevron-right"></i></a>
            </div>
            <!--Controls-->

            <!--Slides-->
            <div class="carousel-inner" role="listbox">

              <!--First slide-->
              <div class="carousel-item active">

                <!--Grid column-->
                <div class="col-md-4">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image1->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title1->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag1->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description1->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star-half-alt"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 clearfix d-none d-md-block">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image2->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title2->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag2->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description2->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 clearfix d-none d-md-block">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image3->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title3->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag3->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description3->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="far fa-star"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

              </div>
              <!--First slide-->

              <!--Second slide-->
              <div class="carousel-item">

                <!--Grid column-->
                <div class="col-md-4">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image4->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title4->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag4->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description4->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star-half-alt"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 clearfix d-none d-md-block">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image5->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title5->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag5->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description5->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 clearfix d-none d-md-block">
                  <div class="testimonial">
                    <!--Avatar-->
                    <div class="avatar mx-auto">
                      <img src="{{ voyager::Image($data->image6->value) }}"
                        class="rounded-circle img-fluid">
                    </div>
                    <!--Content-->
                    <h4 class="font-weight-bold mt-4">{{ $data->title6->value }}</h4>
                    <h6 class="blue-text font-weight-bold my-3">{{ $data->tag6->value }}</h6>
                    <p class="font-weight-normal"><i class="fas fa-quote-left pr-2"></i>{{ $data->description6->value }}</p>
                    <!--Review-->
                    {{-- <div class="grey-text">
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="fas fa-star"> </i>
                      <i class="far fa-star"> </i>
                    </div> --}}
                  </div>
                </div>
                <!--Grid column-->

              </div>
              <!--Second slide-->

          

            </div>
            <!--Slides-->

          </div>
          <!--Carousel Wrapper-->

        </div>

      </section>
      <!--Section: Testimonials v.4-->
</div>