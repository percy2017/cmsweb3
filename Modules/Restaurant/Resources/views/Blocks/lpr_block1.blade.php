<div class="container">
    <section id="about" class="about mt-3 mb-5">
        <div class="row mt-5 mb-4">
            <div class="col-md-12">
                <div class="divider-new">
                    <h3 class="text-center text-uppercase font-weight-bold mr-3 ml-3 wow fadeIn" data-wow-delay="0.2s">
                    {{$data->title_strong->value}}</h3>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-5 col-md-12 mb-3 wow fadeIn" data-wow-delay="0.4s">
                    <img src="{{ voyager::Image($data->image1->value) }}" alt="" class="z-depth-0 img-fluid">
                </div>
                <div class="col-lg-6 offset-lg-1 col-md-12 wow fadeIn" data-wow-delay="0.4s">
                    <h4 class="text-center mb-4">{{ $data->title_default->value }}</h4>
                    <p class="grey-text mb-6 mr-3  ml-3" align="justify">{{  $data->description1->value  }}</p>
                </div>
            </div>
        </div>
    </section>
</div>
mierda -  todos los directorios tienen que ser con minusculas