<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    
    @foreach (json_decode($data->images) as $item)
      @if ($loop->first)
        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="active"></li>
      @else
        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}"></li>
      @endif 
    @endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

    @foreach (json_decode($data->images) as $item)
      @if ($loop->first)
        <div class="item active">
            <img src="{{ Voyager::image($item) }}" alt="...">
            <div class="carousel-caption">
            </div>
        </div>
      @else
        <div class="item">
          <img src="{{ Voyager::image($item) }}" alt="...">
          <div class="carousel-caption">
          </div>
        </div>
      @endif
       
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>