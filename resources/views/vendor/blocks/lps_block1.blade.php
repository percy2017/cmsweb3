<div class="container">
    <section id="features" class="mb-5">

        <h1 class="mb-3 my-5 pt-5 dark-grey-text wow fadeIn text-center" data-wow-delay="0.2s"><strong
            class="font-weight-bold">{{ $data->title_strong->value }}</strong>{{ $data->title_default->value }}</h1>

        <p class="text-center grey-text w-responsive mx-auto mb-5 wow fadeIn" data-wow-delay="0.2s">
            {{ $data->description->value }}
        </p>

                <!--First row-->
        <div class="row features wow fadeIn" data-wow-delay="0.2s">

          <div class="col-lg-4 text-center">
            <div class="icon-area">
              <div class="circle-icon">
                <i class="{{ $data->icons1->value }}"></i>
              </div>
              <br>
              <h5 class="dark-grey-text font-weight-bold mt-2">{{ $data->title1->value }}</h5>
              <div class="mt-1">
                <p class="mx-3 grey-text">{{ $data->descripcion1->value }}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 text-center">
            <div class="icon-area">
              <div class="circle-icon">
                <i class="{{ $data->icons2->value }}"></i>
              </div>
              <br>
              <h5 class="dark-grey-text font-weight-bold mt-2">{{ $data->title2->value }}</h5>
              <div class="mt-1">
                <p class="mx-3 grey-text">{{ $data->descripcion2->value }}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 text-center mb-4">
            <div class="icon-area">
              <div class="circle-icon">
                <i class="{{ $data->icons3->value }}"></i>
              </div>
              <br>
              <h5 class="dark-grey-text font-weight-bold mt-2">{{ $data->title3->value }}</h5>
              <div class="mt-1">
                <p class="mx-3 grey-text">{{ $data->descripcion3->value }}</p>
              </div>
            </div>
          </div>

        </div>
        <!--/First row-->
        

    </section>
</div>
