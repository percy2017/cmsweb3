


    <!--Section: Content-->
    <section class="px-md-5 mx-md-5 text-center dark-grey-text">

      <!--Grid row-->
      <div class="row d-flex justify-content-center">

        <!--Grid column-->
        <div class="col-xl-6 col-md-8">

          <h3 class="font-weight-bold">{{ $data->title_strong->value }}</h3>

          <p class="text-white">{{$data->description->value}}.</p>
          <!-- Featured image -->
        <div class="view overlay mb-4">
          <img class="img-fluid mx-auto " src="https://user-images.githubusercontent.com/14111379/75819948-e1405a00-5d71-11ea-98c6-08fa9d9406f5.png" alt="Responsive image">
          <a>
            <div class="mask rgba-black-slight"></div>
          </a>
        </div>
          {{-- <i class="btn btn-info btn-md ml-0 mb-5" href="#" role="button">Start now<i class="fa fa-magic ml-2"></i></i> --}}

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->


      <!--Grid row-->
      <div class="row text-white">

        <!--First column-->
        <div class="col-lg-3 col-md-6">
          <i class="{{ $data->icons1->value }} fa-3x blue-text"></i>
 
          <p class="font-weight-bold my-3">{{ $data->title1->value }}</p>

          <p class="text-white">{{ $data->decription1->value }}</p>
        </div>
        <!--/First column-->

        <!--Second column-->
        <div class="col-lg-3 col-md-6">
            <i class="{{ $data->icons2->value }} fa-3x teal-text"></i>

            <p class="font-weight-bold my-3">{{ $data->title2->value }}</p>
  
            <p class="text-white">{{ $data->decription2->value }}</p>
        </div>
        <!--/Second column-->

        <!--Third column-->
        <div class="col-lg-3 col-md-6">
            <i class="{{ $data->icons3->value }} fa-3x indigo-text"></i>

            <p class="font-weight-bold my-3">{{ $data->title3->value }}</p>
  
            <p class="text-white">{{ $data->decription3->value }}</p>
        </div>
        <!--/Third column-->

        <!--Fourth column-->
        <div class="col-lg-3 col-md-6">
            <i class="{{ $data->icons4->value }} fa-3x deep-purple-text"></i>

            <p class="font-weight-bold my-3">{{ $data->title4->value }}</p>
  
            <p class="text-white">{{ $data->decription4->value }}</p>
        </div>
        <!--/Fourth column-->

      </div>
      <!--/Grid row-->


    </section>
    <!--Section: Content-->



    <hr class="my-5" style="border: 1px solid #6e6e6e;">