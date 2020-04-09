<div class="container my-5">


    <!--Section: Content-->
    <section class="text-center dark-grey-text" id="pricing" >
  
      <!-- Section heading -->
      <h3 class="font-weight-bold pb-2 mb-4">{{ $data->title->value }}</h3>
      <!-- Section description -->
       <p class="text-muted w-responsive mx-auto mb-5">{{ $data->description->value }}</p>
  
      <!-- Grid row -->
      <div class="row">
  
        <!-- Grid column -->
        <div class="col-lg-4 col-md-12 mb-4">
  
          <!-- Card -->
          <div class="pricing-card card ">
  
            <!-- Content -->
            <div class="card-body">
            <h5 class="font-weight-bold mt-3">{{ $data->pricing1_title->value }}</h5>
  
              <!-- Price -->
              <div class="price pt-0"> 
                <h2 class="number red-text mb-0">{{ $data->pricing1_price->value }}</h2>
              </div>
  
              <ul class="striped mb-1">
                <li>
                  <p><strong></strong> {{ $data->pricing1_description1->value }}</p>
                </li>
                <li>
                  <p><strong></strong> {{ $data->pricing1_description2->value }}</p>
                </li>
                <li>
                  <p><strong></strong> {{ $data->pricing1_description3->value }}</p>
                </li>
                
              </ul>
            <a  href="{{ $data->pricing1_button4->value }}" class="btn btn-danger btn-rounded mb-4">Comenzar</a>
  
            </div>
            <!-- Content -->
  
          </div>
          <!-- Card -->
  
        </div>
        <!-- Grid column -->
  
        <!--  Grid column  -->
        <div class="col-lg-4 col-md-6 mb-4">
  
          <!-- Card -->
          <div class="card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table%20(8).jpg');">
  
            <!-- Pricing card -->
            <div class="text-white text-center pricing-card d-flex align-items-center rgba-indigo-strong py-3 px-3 rounded">
  
              <!-- Content -->
              <div class="card-body">
                <h5 class="font-weight-bold mt-2">{{ $data->pricing2_title->value }}</h5>
  
                <!--Price -->
                <div class="price pt-0">
                  <h2 class="number mb-0">{{ $data->pricing2_price->value }}</h2>
                </div>
  
                <ul class="striped mb-0">
                  <li>
                    <p><strong></strong> {{ $data->pricing2_description1->value }}</p>
                  </li>
                  <li>
                    <p><strong></strong> {{ $data->pricing2_description2->value }}</p>
                  </li>
                  <li>
                    <p><strong></strong>{{ $data->pricing2_description3->value }}</p>
                  </li>
                </ul>
              <a  href="{{ $data->pricing2_button4->value }}" class="btn btn-rounded btn-outline-white">Comenzar</a>
  
              </div>
              <!-- Content -->
  
            </div>
            <!-- Pricing card -->
  
          </div>
          <!-- Card -->
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-lg-4 col-md-6 mb-4">
  
          <!-- Card -->
          <div class="pricing-card card">
  
            <!-- Content -->
            <div class="card-body">
              <h5 class="font-weight-bold mt-3">{{ $data->pricing3_title->value }}</h5>
  
              <!-- Price -->
              <div class="price pt-0">
                <h2 class="number red-text mb-0">{{ $data->pricing3_price->value }}</h2>
              </div>
  
              <ul class="striped mb-1">
                <li>
                  <p><strong></strong> {{ $data->pricing3_description1->value }}</p>
                </li>
                <li>
                  <p><strong></strong> {{ $data->pricing3_description2->value }}</p>
                </li>
                <li>
                  <p><strong></strong> {{ $data->pricing3_description3->value }}</p>
                </li>
                
              </ul>
            <a href="{{ $data->pricing3_button4->value }}" class="btn btn-danger btn-rounded mb-4"> Comenzar</a>
  
            </div>
            <!-- Content -->
  
          </div>
          <!-- Card -->
  
        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Grid row -->
  
    </section>
    <!--Section: Content-->
  
  
  </div>