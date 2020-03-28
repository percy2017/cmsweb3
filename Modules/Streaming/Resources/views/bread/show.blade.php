<div class="page-content browse container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <form method="post" id="search_form" class="form-search" action="{{ url('admin/memberships/search') }}">
                  {{ csrf_field() }}
                    <div id="search-input">
                        <div class="input-group col-md-3">
                        
                            <select class="form-control select2" id="search_type" name="search_type">
                                @foreach($dataType->browseRows as $row)
                                    @if (isset($search_type))
                                      <option value="{{ $row->field }}" @if($search_type == $row->field) selected @endif>{{ $row->display_name }}</option>
                                    @else
                                      <option value="{{ $row->field }}" @if($dataType->details->{'default_search_key'} == $row->field) selected @endif>{{ $row->display_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group col-md-9">
                            <input type="text" class="form-control" placeholder="{{ __('voyager::generic.search') }}" name="search_text" id="search_text" value="@if(isset($search_text)){{ $search_text }}@endif">
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
                        <tr id="{{ $data->id }}">
                          @foreach($dataType->browseRows as $row)
                            <td>
                              @switch($row->type)
                                  @case('text')
                                    <div>{{ mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field} }}</div>    
                                    @break
                                  @case('checkbox')
                                  
                                    @if(isset($row->details->on) && isset($row->details->off))
                                        @if($data->{$row->field})
                                            <span class="label label-info">{{ $row->details->on }}</span>
                                        @else
                                            <span class="label label-primary">{{ $row->details->off }}</span>
                                        @endif
                                    @else
                                      <span class="label label-info">{{ $row->details->on }}</span>
                                      {{ $data->{$row->field} }}
                                    @endif
                                    @break
                                  @case('timestamp')
                                    {{ \Carbon\Carbon::parse($data->{$row->field})->DiffForHumans(\Carbon\Carbon::now()) }}
                                    @break
                                  @case('image')
                                    <img src="@if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif" style="width:60px">
                                    @break
                                  @case('multiple_images')
                                    @php
                                      $images_field = $data->{$row->field};
                                    @endphp  
                                    @if(isset($images_field))
                                    @foreach (json_decode($images_field) as $item)
                                        @if($loop->first)
                                        <a href="javascript:;" onclick="ajax_first('{{ $data->id }}', '{{ $dataType->slug }}')">
                                            <img src="{{ Voyager::image($item) }}"width="60px">
                                        </a>
                                        @endif
                                        @break
                                    @endforeach
                                    @endif
                                    @break
                                  @case('select_dropdown')
                                    @if(isset($row->details->relationship))
                                      @php
                                          $model=$row->details->relationship->{'model'};  
                                          $data_browse=$model::where($row->details->relationship->{'key'} ,$data->{$row->field})->first();
                                          $key=$row->details->relationship->{'key'};
                                          $label=$row->details->relationship->{'label'};
                                      @endphp
                                      {{ $data_browse->$label }}
                                    @else
                                    <span>{{ $data->{$row->field} }}</span>
                                    @endif
                                    @break
                                  @case('relationship')
                                
                                    @php
                                        $model = app($row->details->model);
                                        $column = $row->details->{'column'};
                                        $query = $model::where('id', $data->$column)->first();
                                        $label=$row->details->{'label'};
                                    @endphp
                                    <span>{{ $query->$label }}</span>    
                                    @break
                                  @default
                                    <span>{{ $data->{$row->field} }}</span>
                              @endswitch
                            </td>
                          @endforeach
                            
                            <td class="no-sort no-click bread-actions">
                                <a href="#" onclick="ajax('{{ route('voyager.'.$dataType->name.'.edit', $data->id) }}', 'get')" title="#" class="btn btn-primary">
                                  <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                </a>
                              
                                <a href="#" onclick="ajax('{{ route('voyager.memberships.destroy', $data->id) }}', 'delete')" title="Eliminar" class="btn btn-danger">
                                  <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                                </a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="text-center">
                  {{ $dataTypeContent->links() }}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>

  $('#search_type').select2();
  //$( "#search_text" ).focus();

  $('body').on('click', '.pagination a', function(e) {
      e.preventDefault();

      <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
      $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');   
      var url = $(this).attr('href');  
      $.ajax({
        type: 'get',
        url : url,
        success: function (data) {
          $('#ajax_body').html(data); 
        }, 
        error: function () {
          message('error', 'Error en la accion');
        }
      });
      //window.history.pushState("", "", url);
  });
  
  var frm = $('#search_form');
  $("#search_form").submit(function() {
    event.preventDefault();

      <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
      $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');            
      $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data) {
          $('#ajax_body').html(data);
          //message('info', $('#dataTable >tbody >tr').length);
        },
        error: function (data) {  
          message('error', 'Error en la accion')
        }
    });
  
  });
</script>