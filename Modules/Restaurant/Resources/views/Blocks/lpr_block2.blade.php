    <div class="streak streak-photo streak-md" style="background-image: url('{{ voyager::Image($data->image2->value) }}');">
      <div class="flex-center mask rgba-black-strong">
        <div class="text-center white-text">
          <h2 class="h2-responsive mb-5">
            <i class="fas fa-quote-left" aria-hidden="true"></i>{{$data->title_default->value}}<i class="fas fa-quote-right" aria-hidden="true"></i>
          </h2>
          <h5 class="text-center font-italic">{{$data->title_normal->value}}</h5>
        </div>
      </div>
    </div>