    <!--Section: Products-->
    <div class="container">

      <section id="specials">

        <!--Secion heading-->
        <div class="row mt-5 mb-4">
          <div class="col-md-12">
            <div class="divider-new">
              <h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">{{$data->title_strong->value}}</h3>
            </div>
          </div>

          <p class="grey-text text-center ml-3 mr-3 mt-1 mb-5">{{$data->description->value}}</p>

          <!--First row-->
          <div class="row text-center mr-2 ml-2 mt-3">

            <!--First column-->
            <div class="col-lg-4 col-md-12 mb-4 wow fadeIn" data-wow-delay="0.4s">

              <!--Card-->
              <div class="card card-cascade wider">

                <!--Card image-->
                <div class="view view-cascade overlay zoom">
                  <img src="{{ voyager::Image($data->card1_image->value) }}" class="img-fluid">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <!--/Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade text-center">
                  <!--Title-->
                  <h4 class="card-title">
                    <strong>{{$data->card1_title->value}}</strong>
                  </h4>

                </div>
                <!--/.Card content-->

              </div>
              <!--/.Card-->

            </div>
            <!--/First column-->

            <!--Second column-->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

              <!--Card-->
              <div class="card card-cascade wider">

                <!--Card image-->
                <div class="view view-cascade overlay zoom">
                  <img src="{{ voyager::Image($data->card2_image->value) }}" class="img-fluid">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <!--/Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade text-center">
                  <!--Title-->
                  <h4 class="card-title">
                    <strong>{{$data->card2_title->value}}</strong>
                  </h4>

                </div>
                <!--/.Card content-->

              </div>
              <!--/.Card-->

            </div>
            <!--/Second column-->

            <!--Third column-->
            <div class="col-lg-4 col-md-6 mb-4 wow fadeIn" data-wow-delay="0.4s">

              <!--Card-->
              <div class="card card-cascade wider">

                <!--Card image-->
                <div class="view view-cascade overlay zoom">
                  <img src="{{ voyager::Image($data->card3_image->value) }}" class="img-fluid">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <!--/Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade text-center">
                  <!--Title-->
                  <h4 class="card-title">
                    <strong>{{$data->card3_title->value}}</strong>
                  </h4>

                </div>
                <!--/.Card content-->

              </div>
              <!--/.Card-->

            </div>
            <!--/Third column-->

          </div>
          <!--/First row-->

        </div>

      </section>

    </div>
    <!--/Section: Products-->