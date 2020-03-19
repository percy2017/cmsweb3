    <div class="container">

      <!--Section: Menu intro-->
      <section id="intro" class="mt-3 mb-4">

        <!--Section heading-->
        <div class="row mt-5 mb-4">
          <div class="col-md-12 mb-3">
            <div class="divider-new">
              <h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">{{$data->title_strong->value}}</h3>
            </div>
          </div>
        </div>

        <!--First row-->
        <div class="row smooth-scroll">

          <!--First column-->
          <div class="col-lg-6 col-md-12 wow fadeIn" data-wow-delay="0.4s">

            <!--Title-->
            <h4 class="mb-4 text-center">{{$data->title_default->value}}</h4>

            <!--Description-->
            <p class="grey-text mb-4" align="justify">{{$data->description->value}}</p>

            <!--Menu button-->
            <div class="text-center mb-2 mt-2">
              <a href="{{$data->button->value}}" data-offset="100" class="btn btn btn-outline-grey btn-rounded waves-effect">
                <strong>{{$data->button_title->value}}</strong>
              </a>
            </div>

          </div>
          <!--/First column-->

          <!--Second column-->
          <div class="col-lg-5 ml-auto col-md-12 mb-5 wow fadeIn" data-wow-delay="0.4s">

            <!--Image-->
            <img src="{{ voyager::Image($data->image->value) }}" alt="" class="z-depth-0 img-fluid">

          </div>
          <!--/Second column-->

        </div>
        <!--/First row-->

      </section>
      <!--/Section: Menu intro-->

    </div>
