<div class="row">
    <div class="col-md-12">
        <form class="myform" role="form" action="{{ route('myaccounts_ajax_profile_store', $account_id) }}" id="myform" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
        
            @foreach($dataRows as $row)
            
                @php
                    $display_options = $row->details->display ?? NULL;
                @endphp
                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                    {{ $row->slugify }}
                    @if ($row->add)
                        @switch($row->type)
                            @case('relationship')
                    
                                <label class="control-label" for="{{ $row->details->{'column'} }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                @if(($row->details->{'type'} == 'belongsTo') && ($row->details->{'table'} == 'accounts'))
                                    <input type="text" name="{{ $row->details->{'column'} }}" id="{{ $row->details->{'column'} }}" class="form-control" value="{{ $account_id }}" Readonly />
                                @else
                                
                                    <select 
                                        class="form-control select2" 
                                        name="{{ $row->details->{'column'} }}"
                                        id="{{ $row->details->{'column'} }}" 
                                        @if($row->required == 1) required @endif>
                                        @php
                                            $model = app($row->details->model);
                                            $query = $model::all();
                                        @endphp
                                        <option disabled>-- Seleciona datos --</option>
                                        @foreach($query as $relationshipData)
                                            <option value="{{ $relationshipData->{$row->details->key} }}">{{ $relationshipData->{$row->details->label} }}</option>
                                        @endforeach
                                    </select>    
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
                                @if(isset($row->details->relationship))
                                    @php
                                        $model=$row->details->relationship->{'model'};  
                                        $data=$model::all();
                                        $data=$row->details->relationship->{'model'}::all();
                                        $key=$row->details->relationship->{'key'};
                                        $label=$row->details->relationship->{'label'};
                                    @endphp
                                    <select 
                                        class="form-control select2" 
                                        name="{{ $row->field }}" 
                                        id="{{ $row->field }}" 
                                        @if($row->required == 1) required @endif> 
                                        <option disabled>-- Seleciona un dato --</option>                                          
                                        @foreach ($data  as $item)
                                            <option value="{{ $item->$key }}">{{ $item->$label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select 
                                        class="form-control select2" 
                                        name="{{ $row->field }}" 
                                        id="{{ $row->field }}" 
                                        @if($row->required == 1) required @endif>
                                            <option disabled>-- Seleciona un dato --</option>
                                        @foreach ($row->details->options  as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @break
                            @case('text')
                                <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                <input 
                                    @if($row->required == 1) required @endif 
                                    type="text" 
                                    class="form-control" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" 
                                    @if(isset($row->details->{'minlength'}))minlength="{{ $row->details->{'minlength'} }}"@endif 
                                    @if(isset($row->details->{'maxlength'}))maxlength="{{ $row->details->{'maxlength'} }}"@endif 
                                    @if($row->required == 1) required @endif 
                                    placeholder="{{ $row->field }}" 
                                    value="@if(isset($row->details->{'default'})){{ $row->details->{'default'} }}@endif">
                                @break
                            @case('number')
                                <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" 
                                    @if(isset($row->details->{'min'}))min="{{ $row->details->{'min'} }}"@endif 
                                    @if(isset($row->details->{'max'}))max="{{ $row->details->{'max'} }}"@endif 
                                    @if(isset($row->details->{'step'}))step="{{ $row->details->{'step'} }}"@endif 
                                    @if($row->required == 1) required @endif 
                                    value="@if(isset($row->details->{'default'})){{ $row->details->{'default'} }}@endif">
                                
                                @break
                            @case('text_area')
                                <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                <textarea 
                                    @if($row->required == 1) required @endif 
                                    class="form-control" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" 
                                    @if(isset($row->details->{'minlength'}))minlength="{{ $row->details->{'minlength'} }}"@endif 
                                    @if(isset($row->details->{'maxlength'}))maxlength="{{ $row->details->{'maxlength'} }}"@endif>@if(isset($row->details->{'default'})){{ $row->details->{'default'} }}@endif</textarea>
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
                                <input 
                                    @if($row->required == 1) required @endif 
                                    type="datetime" 
                                    class="form-control datepicker" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" 
                                    value="@if(isset($dataTypeContent->{$row->field})){{ \Carbon\Carbon::parse(old($row->field, $dataTypeContent->{$row->field}))->format('m/d/Y g:i A') }}@else{{old($row->field)}}@endif">
    
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
                                <textarea 
                                    class="form-control richTextBox" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}"></textarea>
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
                                <input 
                                    type="file" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" 
                                    accept="image/*">
                                @break 
                            @case('multiple_images')
                                <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                <input 
                                    type="file" 
                                    name="{{ $row->field }}[]" 
                                    id="{{ $row->field }}" 
                                    multiple="multiple" 
                                    accept="image/*">
                                @break
                            @case('checkbox')
                                <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                @if(isset($row->details->tooltip))
                                    <span class="voyager-question"
                                    aria-hidden="true"
                                    data-toggle="tooltip"
                                    data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                    title="{{ $row->details->tooltip->{'message'} }}"></span>
                                @endif
                                <br>
                                <?php $checked = $row->details->checked ?>
                                <input 
                                    type="checkbox" 
                                    name="{{ $row->field }}" 
                                    id="{{ $row->field }}" s
                                    class="toggleswitch" 
                                    data-on="{{ $row->details->on }}" {!! $checked ? 'checked="checked"' : '' !!} 
                                    data-off="{{ $row->details->off }}">
                            @break
                        @endswitch        
                        @if ($errors->has($row->field))
                            @foreach ($errors->get($row->field) as $error)
                                <span class="help-block">{{ $error }}</span>        
                            @endforeach
                        @endif                              
                    @endif
                    
                </div>
            @endforeach

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" id="button_submit">
                    <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Enviar</span>
                </button>
              
                <a href="javascript:;" onclick="ajax('{{ route('myaccounts_ajax_profile', $account_id) }}', 'get')" title="#" class="btn btn-danger">
                    <i class="voyager-double-left"></i> <span class="hidden-xs hidden-sm">Cancelar</span>
                </a>
            </div>
        </form>
    </div>
</div>


    