@can('read', app($dataType->model_name))

<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="padding-bottom:5px;">
            
                <div class="form-group text-center">
                    <h4>
                        <i class="voyager-eye"></i> {{ __('voyager::generic.viewing').': '.$dataType->display_name_singular }} # {{ $data->id }}
                    </h4>
                    <hr/>
                
                </div>
                <div class="panel-body">
                    @foreach($dataRows as $row)
                        @php
                            $display_options = $row->details->display ?? NULL;
                        @endphp
                        <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                            @php
                                $myfield = $row->field;
                            @endphp
                            @switch($row->type)
                                @case('relationship')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @if($row->details->{'type'} == 'belongsTo')
                                        @if(isset($row->details->tooltip))
                                            <span class="voyager-question"
                                            aria-hidden="true"
                                            data-toggle="tooltip"
                                            data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                            title="{{ $row->details->tooltip->{'message'} }}"></span>
                                        @endif
                                        @php
                                            $model = app($row->details->model);
                                            $column = $row->details->{'column'};
                                            $query = $model::where('id', $data->$column)->first();
                                            $label=$row->details->{'label'};
                                        @endphp
                                        <h4><code> {{ $query->$label }} </code></h4>
                                    @elseif($row->details->{'type'} == 'belongsToMany')
                                        @php
                                            $model = app($row->details->model);
                                            $query = $model::all();

                                            $mymodel = app($row->details->attributes->model);
                                            $mycolumn = $row->details->attributes->{'column'};
                                            $mykey = $row->details->attributes->{'key'};
                                            $myquery = $mymodel::where($mycolumn, $data->id)->get();

                                            $myrelationships = false;
                                        @endphp
                                        <h4>
                                            @foreach($query as $relationshipData)
                                                @foreach ($myquery as $item)
                                                    @if ($item->$mykey == $relationshipData->{$row->details->key})
                                                        @php $myrelationships = true; @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($myrelationships)
                                                    <code>{{ $relationshipData->{$row->details->label} }}</code>
                                                @endif
                                        
                                                @php $myrelationships = false; @endphp
                                            @endforeach
                                        </h4>
                                    @endif
                                    @break
                                @case('select_dropdown')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @if(isset($row->details->tooltip))
                                        <span class="voyager-question"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                        title="{{ $row->details->tooltip->{'message'} }}"></span>
                                    @endif
                                
                                    @foreach ($row->details->options  as $item)
                                        @if($item==$data->$myfield)
                                            <h4><code> {{ $item }} </code></h4>
                                            @break
                                        @endif
                                    @endforeach
                                    </select>
                                    
                                    @break

                                @case('timestamp')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @if(isset($row->details->tooltip))
                                        <span class="voyager-question"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                        title="{{ $row->details->tooltip->{'message'} }}"></span>
                                    @endif

                                    <h4><code>{{ \Carbon\Carbon::parse($data->{$row->field})->DiffForHumans(\Carbon\Carbon::now()) }}</code></h4>
                                 
                                    <small>{{ $data->{$row->field} }}</small>
                                    @break
                                @case('rich_text_box')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                               
                                    @if(isset($row->details->tooltip))
                                        <span class="voyager-question"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                        title="{{ $row->details->tooltip->{'message'} }}"></span>
                                    @endif
                                    <br />
                                    {!!  htmlspecialchars_decode($data->{$row->field})  !!}
                                    @break
                                @case('image')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @if(isset($row->details->tooltip))
                                        <span class="voyager-question"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                        title="{{ $row->details->tooltip->{'message'} }}"></span>
                                    @endif
                                    <img class="img-responsive" src="{{ Voyager::Image($data->$myfield) }}" width="60%">
                                    
                                    @break 
                                @case('multiple_images')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @php
                                        $images_field = $data->{$row->field};
                                    @endphp  
                                    
                                    @if(isset($images_field))
                                        <div class="row">
                                        @foreach (json_decode($images_field) as $item)
                                            <div class="form-group col-md-{{ 12/count(json_decode($images_field)) }}">
                                                <img class="img-responsive" src="{{ Voyager::image($item) }}">
                                            </div>    
                                        @endforeach
                                        </div>
                                    @endif
                                    @break    
                                @case('checkbox')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    <br/>
                                    @if(isset($row->details->on) && isset($row->details->off))
                                        @if($data->{$row->field})
                                            <code>{{ $row->details->on }}</code>
                                        @else
                                            <code>{{ $row->details->off }}</code>
                                        @endif
                                    @else
                                    <span class="label label-info">{{ $row->details->on }}</span>
                                    {{ $data->{$row->field} }}
                                    @endif
                                    @break
                                @case('Traking')
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                    @if(isset($row->details->tooltip))
                                        <span class="voyager-question"
                                        aria-hidden="true"
                                        data-toggle="tooltip"
                                        data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                        title="{{ $row->details->tooltip->{'message'} }}"></span>
                                    @endif
                                    @php
                                        $user = \App\User::find($data->{$row->field});
                                    @endphp
                                    <h4><code>{{ $user->name }}</code></h4>
                                    @break
                                @default
                                    <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                  
                                    <h4><code>{{ $data->{$row->field} }}</code></h4>
                                    @break
                            @endswitch        
                    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@else
  <div class="page-content browse container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body text-center"> 
              <h3>No tiene los permisos, para ver los datos</h3>
              <code>Consulte con el administrador de Sistema, para realizar la accion</code>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endcan