@can('read', app($dataType->model_name))

<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="padding-bottom:5px;">
            
                <div class="form-group text-center">
                    <h4>
                        <i class="voyager-eye"></i> {{ __('voyager::generic.viewing').': '.$dataType->display_name_singular }}
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
                                            @if(isset($row->details->tooltip))
                                                <span class="voyager-question"
                                                aria-hidden="true"
                                                data-toggle="tooltip"
                                                data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                                title="{{ $row->details->tooltip->{'message'} }}"></span>
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
                                                    <h3><code> {{ $item }} </code></h3>
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

                                            <h3><code>{{ \Carbon\Carbon::parse($data->{$row->field})->DiffForHumans(\Carbon\Carbon::now()) }}</code></h3>
                                            
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
                                            @if(isset($row->details->tooltip))
                                                <span class="voyager-question"
                                                aria-hidden="true"
                                                data-toggle="tooltip"
                                                data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                                title="{{ $row->details->tooltip->{'message'} }}"></span>
                                            @endif
                                            
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
                                            <h3><code>{{ $user->name }}</code></h3>
                                            @break
                                        @default
                                            <label class="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
                                            
                                            <h3><code>{{ $data->{$row->field} }}</code></h3>
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

@endcan