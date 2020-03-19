    <!--Streak-->
    <div class="streak streak-photo streak-long-2" style="background-image:url('{{ voyager::Image($data->image->value) }}')">
      <div class="mask flex-center rgba-black-strong">
        <div class="container">

          <h2 class="text-center text-white mb-5 text-uppercase font-weight-bold wow fadeIn" data-wow-delay="0.2s">{{ $data->title_strong->value }}</h2>

          <!--First row-->
          <div class="row text-white text-center wow fadeIn" data-wow-delay="0.2s">

            <!--First column-->
            <div class="col-md-3 mb-2">
              <h1 class="green-text mb-1 font-weight-bold py-3">{{ $data->services1_number->value }}</h1>
              <p class="mb-3">{{ $data->services1_title->value }}</p>
            </div>
            <!--/First column-->

            <!--Second column-->
            <div class="col-md-3 mb-2">
              <h1 class="green-text mb-1 font-weight-bold py-3">{{ $data->services2_number->value }}</h1>
              <p class="mb-3">{{ $data->services2_title->value }}</p>
            </div>
            <!--/Second column-->

            <!--Third column-->
            <div class="col-md-3 mb-2">
              <h1 class="green-text mb-1 font-weight-bold py-3">{{ $data->services3_number->value }}</h1>
              <p class="mb-3">{{ $data->services3_title->value }}</p>
            </div>
            <!--/Third column-->

            <!--Fourth column-->
            <div class="col-md-3">
              <h1 class="green-text mb-1 font-weight-bold py-3">{{ $data->services4_number->value }}</h1>
              <p class="mb-3">{{ $data->services4_title->value }}</p>

            </div>
            <!--/Fourth column-->

          </div>
          <!--/First row-->
        </div>
      </div>
    </div>
    <!--/Streak-->