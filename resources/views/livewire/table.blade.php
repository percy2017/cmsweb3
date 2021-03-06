  <div id="app">
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
                                      <a href="javascript:;" onclick="ajax('{{ route('myaccounts_ajax_profile', $data->id) }}', 'get')" title="#" class="btn btn-success">
                                        <i class="voyager-group"></i> <span class="hidden-xs hidden-sm">Perfiles</span>
                                      </a>
                                      <a href="{{ route('myproducts.edit', $data->id) }}" title="#" class="btn btn-primary">
                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                      </a>
                                    
                                      <a href="javascript:;" onclick="destroy('{{ $data->id }}' ,'{{ route('myaccounts_ajax_destroy', [$data->id, 'accounts'])   }}')" title="Eliminar" class="btn btn-danger">
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
  </div>