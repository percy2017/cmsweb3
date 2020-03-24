@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')
  <div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    </h1>

      <div class="btn-group">
        <button type="button" class="btn btn-dark"><i class="voyager-tools"></i> <span>Acciones</span></button>
        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="{{ route('myproducts.create') }}">Nuevo Producto</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="{{ route('voyager.supplies.index') }}" id="supllies_index">Insumos</a></li>
          <li><a href="{{ route('voyager.extras.index') }}">Extras</a></li>
          <li><a href="{{ route('voyager.categories.index') }}">Categorias</a></li>
          <li><a href="{{ route('voyager.sub_categories.index') }}">Sub Categorias</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="{{ route('voyager.bread.edit', $dataType->slug) }}">Configuracion</a></li>
        </ul>
      </div>
  </div>
@stop
@section('css')
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
                                          {{ \Carbon\Carbon::parse($data->{$row->field})->DiffForHumans(\Carbon\Carbon::now()) }}
                                      @endif
                                    
                                    @elseif($row->type == 'image')
                                      <img src="@if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif" style="width:100px">
                                    
                                    @elseif($row->type == 'multiple_images')
                                      @php
                                          $images_field = $data->{$row->field};
                                      @endphp  
                                          @if(isset($images_field))
                                            @foreach (json_decode($images_field) as $item)
                                              @if($loop->first)
                                                <div data-field-name="{{ $row->field }}">
                                            
                                                <a href="javascript:;" onclick="modal_images('{{ route('myproducts_ajax_images', [$data->id, 'products']) }}')">
                                                  <img 
                                                    src="{{ Voyager::image($item) }}" 
                                                    data-file-name="{{ $row->field }}" 
                                                    data-id="{{ $row->field }}" 
                                                    width="60px">
                                                    </div>
                                                  </a>
                                              @endif
                                              @break
                                            @endforeach
                                          @endif
                                      
                                      
                                    
                                    @elseif($row->type == 'relationship')
                                      @if($row->details->{'type'} == 'belongsTo')
                                        
                                      @else
                                     
                                      @endif
                                    @elseif($row->type == 'select_dropdown') 
                                      @if($row->details->relationship)
                                        @php
                                            $model=$row->details->relationship->{'model'};  
                                            $data_browse=$model::where($row->details->relationship->{'key'} ,$data->{$row->field})->first();
                                            $key=$row->details->relationship->{'key'};
                                            $label=$row->details->relationship->{'label'};
                                        @endphp
                                        {{ $data_browse->$label }}
                                        
                                      @endif
                 
                                    @else
                                      <span>{{ $data->{$row->field} }}</span>
                                    @endif  
                                  </td>
                                
                                @endforeach
                                  
                                  <td class="no-sort no-click bread-actions">
                                   <a href="{{ route('myproducts.edit', $data->id) }}" title="#" class="btn btn-warning">
                                      <i class="voyager-bread"></i> <span class="hidden-xs hidden-sm">Ducplicar</span>
                                    </a>
                                    <a href="{{ route('myproducts.edit', $data->id) }}" title="#" class="btn btn-primary">
                                      <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                    </a>
                                   
                                    <a href="{{ route('myproducts.edit', $data->id) }}" title="#" class="btn btn-danger">
                                      <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
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

<!-- Modal -->
<div class="modal modal-info fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div id="modal_title"></div>
      </div>
      <div class="modal-body">
        <div id="modal_body"></div>
      </div>
    </div>
  </div>
</div>
@stop
@section('javascript')
<script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
  <script>
      $(document).ready(function () {
         
      });

      $(window).bind('keydown', function(event) {
        if(event.ctrlKey || event.metaKey) {
          switch (String.fromCharCode(event.which).toLowerCase()) {
          case 'c':
              event.preventDefault();
              window.location = '{{ route('myproducts.create') }}';
              break;
          case 'f':
              event.preventDefault();
              $('#supllies_index').click();
              alert('ctrl-f');
              break;
          case 'g':
              event.preventDefault();
              alert('ctrl-g');
              break;
          }
        }
      });


      //---funciones --------
      function modal_images(urli){

         $.ajax({
            type: "get",
            url: urli,
            success: function (response) {
              
                $('#modal_title').html('<h4 class="modal-title"><i class="voyager-photo"></i> Imagenes</h4>');
                $('#modal_body').html(response);
                $('#myModal').modal('show');
            }
        });
      }


  </script>
@stop