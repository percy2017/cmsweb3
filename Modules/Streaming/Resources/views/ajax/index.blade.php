<div class="table-responsive">

  @if(count($dataTypeContent)>0)
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
                    @default
                      <span>{{ $data->{$row->field} }}</span>
                @endswitch
              </td>
            @endforeach
              
              <td class="no-sort no-click bread-actions">
                <a href="javascript:;" id="profiles" title="#" class="btn btn-success">
                    <i class="voyager-group"></i> <span class="hidden-xs hidden-sm">Perfiles</span>
                  </a>
                <a href="{{ route('myproducts.edit', $data->id) }}" title="#" class="btn btn-primary">
                  <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                </a>
              
                <a href="javascript:;" onclick="destroy('{{ $data->id }}' ,'{{ route('myaccount_ajax_destroy', [$data->id, 'accounts'])   }}')" title="Eliminar" class="btn btn-danger">
                  <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                </a>
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>
  @else
    <div class="text-center">
      <h3>No hay datos registrados</h3>
      <button class="btn btn-primary" onclick="ajax_index('{{ route('ajax_create', 'profiles') }}')"><i class="voyager-edit"></i> Nuevo ?</button>
    </div>

  @endif
</div>