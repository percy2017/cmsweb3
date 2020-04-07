@extends('layouts.app')

@section('content')
 <div class="container">
    
    <section class="section py-5">
      <!-- First row -->
      <div class="row">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <!-- First column -->
        <div class="col-lg-4 mb-4">
  
          <!-- Card -->
          <div class="card card-cascade narrower">
           
            <!-- Card image -->
            <div class="view view-cascade gradient-card-header blue-gradient mdb-color lighten-3">
              <h5 class="mb-0 font-weight-bold">Foto</h5>
            </div>
            <!-- Card image -->
  
            <!-- Card content -->
            <div class="card-body card-body-cascade text-center">
              <img src="{{ Voyager::Image(Auth::user()->avatar) }}" class="img-thumbnail"  style="width: 130px" />
  
              <p class="text-muted"><small>Bienvenido al mejor CmsWeb</small></p>
               {{ dd(Voyager::model('User')) }}
              <div class="row flex-center">
                {{--  @if(Auth::user()->role->id == 1)  --}}
                <a class="btn btn-info btn-rounded btn-sm" href="{{ route('voyager.dashboard') }}">Ir a Panel</a>
                {{--  @endif  --}}
                <a class="btn btn-danger btn-rounded btn-sm" href="/">Volver</a>
              </div>
            </div>
            <!-- Card content -->
  
          </div>
          <!-- Card -->
  
        </div>
        <!-- First column -->
  
        <!-- Second column -->
        <div class="col-lg-8 mb-4">
  
          <!-- Card -->
          <div class="card card-cascade narrower">
  
            <!-- Card image -->
            <div class="view view-cascade gradient-card-header  blue-gradient mdb-color lighten-3">
              <h5 class="mb-0 font-weight-bold">Mi Perfil</h5>
            </div>
            <!-- Card image -->
  
            <!-- Card content -->
            <div class="card-body card-body-cascade text-center">
  
              <!-- Edit Form -->
              <form>
  
                <!-- First row -->
                <div class="row">
                  <!-- First column -->
                  <div class="col-md-6">
                    <div class="md-form mb-0">
                      <input type="text" id="form1" class="form-control" value="{{ Auth::user()->name }}" disabled>
                      <label style="font-size: 1.1rem;" for="form1" data-error="wrong" data-success="right">Nombres
                        :</label>
  
                    </div>
                  </div>
  
                  <!-- Second column -->
                  <div class="col-md-6">
                    <div class="md-form mb-0">
                      <input type="text" id="form1" class="form-control validate" value="{{ Auth::user()->role->name }}"
                        disabled>
                      <label style="font-size: 1.1rem;" for="form1" data-error="wrong" data-success="right">Rol :</label>
                    </div>
                  </div>
                </div>
                <!-- First row -->
  
                <!-- Second row -->
                <div class="row">
  
                  <!-- First column -->
                  <div class="col-md-6">
                    <div class="md-form mb-0">
                      <input type="text" id="form1" class="form-control validate" value="{{ Auth::user()->email }}"
                        disabled>
                      <label style="font-size: 1.1rem;" for="form1" data-error="wrong" data-success="right">Email
                        :</label>
                    </div>
                  </div>
                  <!-- Second column -->
  
                  <div class="col-md-6">
                    <div class="md-form mb-0">
                      <input type="text" id="form1" class="form-control validate" value="{{ Auth::user()->created_at }}"
                        disabled>
                      <label style="font-size: 1.1rem;" for="form1" data-error="wrong" data-success="right">Registro
                        :</label>
                    </div>
                  </div>
                </div>
                <!-- Second row -->
  
              </form>
              <!-- Edit Form -->
  
            </div>
            <!-- Card content -->
  
          </div>
          <!-- Card -->
  
        </div>
        <!-- Second column -->
  
      </div>
      <!-- First row -->
    </section>
  </div>
@endsection
