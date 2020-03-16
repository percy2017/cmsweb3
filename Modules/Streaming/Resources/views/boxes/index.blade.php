@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
        </h1>
        <a href="{{ route('voyager.bread.edit', $dataType->slug) }}" class="btn btn-dark" target="_blank">
            <i class="voyager-params"></i> <span>Configuracion</span>
        </a>
        <a href="{{ route('myboxes.create') }}" class="btn btn-primary">
            <i class="voyager-plus"></i> <span>Nuevo</span>
        </a>
      
    </div>
@stop

@section('content')
  <div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
          <div class="panel-body">
            <form method="get" class="form-search">
                <div id="search-input">
                    <div class="input-group col-md-3">
                        <select class="form-control select2">
                          @foreach($dataType->browseRows as $row)
                            <option value="{{ $row->field }}">{{ $row->getTranslatedAttribute('display_name') }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="input-group col-md-9">
                        <input type="text" class="form-control" placeholder="{{ __('voyager::generic.search') }}" name="s" value="">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="voyager-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
              <table id="dataTable" class="table table-hover">
                <thead>
                    <tr>
                      @foreach($dataType->browseRows as $row)
                        <th>
                          {{ $row->getTranslatedAttribute('display_name') }}
                        </th>
                        @endforeach
                        <th class="actions">{{ __('voyager::generic.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($dataTypeContent as $data)
                    <tr>
                      @foreach($dataType->browseRows as $row)
                        <td>
                          @if($row->type == 'text')
                            @include('voyager::multilingual.input-hidden-bread-browse')
                            <div>{{ mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field} }}</div>
                          @elseif($row->type == 'checkbox')
                            @if(property_exists($row->details, 'on') && property_exists($row->details, 'off'))
                                @if($data->{$row->field})
                                    <span class="label label-info">{{ $row->details->on }}</span>
                                @else
                                    <span class="label label-primary">{{ $row->details->off }}</span>
                                @endif
                            @else
                            {{ $data->{$row->field} }}
                            @endif
                          @elseif($row->type == 'date' || $row->type == 'timestamp')
                            @if ( property_exists($row->details, 'format') && !is_null($data->{$row->field}) )
                                {{ \Carbon\Carbon::parse($data->{$row->field})->formatLocalized($row->details->format) }}
                            @else
                                {{ $data->{$row->field} }}
                            @endif
                           @elseif($row->type == 'image')
                              <img src="@if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif" style="width:100px">
                            @elseif($row->type == 'relationship')
                              @include('voyager::formfields.relationship', ['view' => 'browse','options' => $row->details])
                            
                          @else
                            @include('voyager::multilingual.input-hidden-bread-browse')
                            <span>{{ $data->{$row->field} }}</span>
                          @endif  
                        </td>
                      
                      @endforeach
                        
                        <td class="no-sort no-click bread-actions">
                          <a href="{{ route('box_seatings', $data->{$row->field}) }}" title="#" class="btn btn-dark">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Asientos</span>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
@stop
@section('javascript')
     <script src="{{ asset('js/app.js') }}"></script>
  <script>
    Echo.channel('home').listen('NewMessage', (e) => {
        toastr.success(e.message);
        location.reload();
    });
  </script>
@endsection