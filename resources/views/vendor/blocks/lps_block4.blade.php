<div class="container">
    <!--Section: Pricing v.3-->
    <section class="mt-4 mb-5">

    <!--Section heading-->
    <h1 class="mb-3 my-5 pt-5 text-center dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong
        class="font-weight-bold">{{ $data->title_strong->value }}</strong> {{ $data->title_default->value }}</h1>

    <!--Section description-->
    <p class="text-center w-responsive mx-auto my-5 grey-text">{{ $data->description->value }}</p>

    <!--First row-->
    <div class="row">

        <!--First column-->
        <div class="col-lg-4 col-md-12 mb-4">
        <!--Card-->
        <div class="card">

            <!--Content-->
            <div class="text-center">
            <div class="card-body">
                <h5>{{ $data->title1->value }}</h5>
                <div class="d-flex justify-content-center">
                <div class="card-circle d-flex justify-content-center align-items-center">
                    <i class="{{ $data->icons1->value }}"></i>
                </div>
                </div>

                <!--Price-->
                <h2 class="font-weight-bold dark-grey-text mt-3"><strong>{{ $data->price1->value }}</strong></h2>
                <p class="grey-text">{{ $data->description1->value }}</p>
                <a class="btn btn-blue font-weight-bold btn-rounded">Comprar Ahora</a>
            </div>
            </div>

        </div>
        <!--/.Card-->
        </div>
        <!--/First column-->

        <!--Second column-->
        <div class="col-lg-4 col-md-12 mb-4">
        <!--Card-->
        <div class="card blue-gradient">

            <!--Content-->
            <div class="text-center white-text">
            <div class="card-body">
                <h5>{{ $data->title2->value }}</h5>
                <div class="d-flex justify-content-center">
                <div class="card-circle d-flex justify-content-center align-items-center">
                    <i class="{{ $data->icons2->value }}"></i>
                </div>
                </div>

                <!--Price-->
                <h2 class="font-weight-bold white-text mt-3"><strong>{{ $data->price2->value }}</strong></h2>
                <p>{{ $data->description2->value }}</p>
                <a class="btn btn-white font-weight-bold btn-rounded">Conprar Ahora</a>
            </div>
            </div>

        </div>
        <!--/.Card-->
        </div>
        <!--/Second column-->

        <!--Third column-->
        <div class="col-lg-4 col-md-12 mb-4">
        <!--Card-->
        <div class="card">

            <!--Content-->
            <div class="text-center">
            <div class="card-body">
                <h5>{{ $data->title3->value }}</h5>
                <div class="d-flex justify-content-center">
                <div class="card-circle d-flex justify-content-center align-items-center">
                    <i class="{{ $data->icons3->value }}"></i>
                </div>
                </div>

                <!--Price-->
                <h2 class="font-weight-bold dark-grey-text mt-3"><strong>{{ $data->price3->value }}</strong></h2>
                <p class="grey-text">{{ $data->description3->value }}</p>
                <a class="btn btn-blue font-weight-bold btn-rounded">Comprar Ahora</a>
            </div>
            </div>

        </div>
        <!--/.Card-->
        </div>
        <!--/Third column-->

    </div>
    <!--/First row-->

    </section>
    <!--/Section: Pricing v.3-->
</div>