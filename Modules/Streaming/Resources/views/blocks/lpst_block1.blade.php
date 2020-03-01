<!--Section: Main info-->
<section class="mt-5 wow fadeIn">

    <!--Grid row-->
    <div class="row">
  
      <!--Grid column-->
      <div class="col-md-6 mb-4">
  
      <img src="{{ voyager::Image($data->image1->value)  }}" class="img-fluid z-depth-1-half"
          alt="">
  
      </div>
      <!--Grid column-->
  
      <!--Grid column-->
      <div class="col-md-6 mb-4">
        <!-- Main heading -->
        <h3 class="h3 mb-3">{{ $data->title_strong->value }}.</h3>
      <p>{{ $data->description->value }}</p>
        <!-- Main heading -->
  
        <hr>
  
        {{-- <p>
          <strong>400+</strong> material UI elements,
          <strong>600+</strong> material icons,
          <strong>74</strong> CSS animations, SASS files, templates, tutorials and many more.
          <strong>Free for personal and commercial use.</strong>
        </p> --}}
  
        <!-- CTA -->
        {{-- <a target="_blank" href="#" class="btn btn-grey btn-md">Download
          <i class="fas fa-download ml-1"></i>
        </a>
        <a target="_blank" href="#" class="btn btn-grey btn-md">Live
          demo
          <i class="far fa-image ml-1"></i>
        </a>
   --}}
      </div>
      <!--Grid column-->
  
    </div>
    <!--Grid row-->
  
  </section>
  <!--Section: Main info-->
   <hr class="my-5">