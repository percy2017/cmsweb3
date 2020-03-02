<!--Third container-->
<div class="streak streak-md streak-photo"
    style="background-image:url('https://mdbootstrap.com/img/Photos/Others/architecture.jpg')">
    <div class="flex-center white-text blue-gradient-mask">
    <div class="container py-3">

        <!--Section: Features v.4-->
        <section class="wow fadeIn" data-wow-delay="0.2s">

        <!--Section heading-->
        <h1 class="py-5 my-5 white-text text-center wow fadeIn" data-wow-delay="0.2s"><strong
            class="font-weight-bold">{{ $data->title_strong->value }}</strong> {{ $data->title_default->value }}</h1>

        <!--Grid row-->
        <div class="row features-small mb-5">

            <!--Grid column-->
            <div class="col-md-12 col-lg-4">

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons1->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title1->value }}</h5>
                <p class="white-text">{{ $data->description1->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons2->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title2->value }}</h5>
                <p class="white-text">{{ $data->description2->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons3->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title3->value }}</h5>
                <p class="white-text">{{ $data->description3->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-12 col-lg-4 px-5 mb-2 text-center text-md-left flex-center">
            <img src="{{ voyager::Image($data->image_principal->value) }}" alt=""
                class="z-depth-0 img-fluid">
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-12 col-lg-4">

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons4->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title4->value }}</h5>
                <p class="white-text">{{ $data->description4->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons5->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title5->value }}</h5>
                <p class="white-text">{{ $data->description5->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row mb-5">
                <div class="col-3">
                <a type="button" class="btn-floating white btn-lg my-0"><i class="{{ $data->icons6->value }}"
                    aria-hidden="true"></i></a>
                </div>
                <div class="col-9">
                <h5 class="font-weight-bold white-text">{{ $data->title6->value }}</h5>
                <p class="white-text">{{ $data->description6->value }}</p>
                </div>
            </div>
            <!--Grid row-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        </section>
        <!--/Section: Features v.4-->
    </div>
    </div>
</div>
<!--/Third container-->