<!--Second container-->
<div class="container-fluid" style="background-color: #f9f9f9">
    <div class="container py-4">

    <!--Section: Download-->
    <section>

        <!-- First row -->
        <div class="row my-4 pt-5 wow fadeIn" data-wow-delay="0.4s">

        <!-- First column -->
        <div class="col-lg-7 col-md-12 mb-4 text-center">
        
            <img src="{{ voyager::Image($data->image_donwload->value) }}" alt="{{ $data->image_donwload->value }}"
            class="img-fluid z-depth-2 rounded">
        </div>
        <!-- /First column -->

        <!-- Second column -->
        <div class="col-lg-5 col-md-12 mb-4 text-left">

            <!--Section heading-->
            <h2 class="mb-3 my-5 dark-grey-text wow fadeIn" data-wow-delay="0.2s"><strong
                class="font-weight-bold">{{ $data->title_strong->value }}</strong> {{ $data->title_default->value }}</h2>

            <p class="grey-text mb-4">{{$data->desription->value}}</p>

            <a class="btn btn-white btn-rounded blue-text font-weight-bold ml-0 wow fadeIn" data-wow-delay="0.2s"><i
            class="fab fa-android pr-2" aria-hidden="true"></i> {{ $data->button1->value }}</a>
            
            <a class="btn btn-white btn-rounded blue-text font-weight-bold wow fadeIn" data-wow-delay="0.2s"><i
                class="fab fa-apple pr-2" aria-hidden="true"></i> {{ $data->button2->value }}</a>
            
        </div>
        <!-- /.Second column -->

        </div>
        

    </section>
    <!--/Section: Download-->

    </div>
</div>
<!--Second container-->