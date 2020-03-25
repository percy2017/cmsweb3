@extends('voyager::master')

@section('page_title', 'Agregando '.$dataType->getTranslatedAttribute('display_name_singular')) 

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
            <li><a href="javascript:;" id="save">(ctrl+q) Guardar</a></li>
            <li><a href="#" id="continue">Guardar y Continuar</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('voyager.bread.edit', $dataType->slug) }}">Configuracion</a></li>
        </ul>
      </div>
    </div>
@stop
@section('css')
    <style>
        .myform div label span.error { color: red; }
    </style>
@stop
@section('content')
<div class="page-content container-fluid" id="voyagerBreadEditAdd">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-primary panel-bordered">
                <form class="myform" role="form" action="{{ route('myaccounts.store') }}" id="myform" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        @foreach($dataRows as $row)
                        
                            @php
                                $display_options = $row->details->display ?? NULL;
                            @endphp
                            <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                {{ $row->slugify }}
                               @if ($row->add)
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
                                        @if($row->details->{'type'} == 'belongsTo')
                                                <select 
                                                    class="form-control select2" 
                                                    name="{{ $row->field }}"
                                                    id="{{ $row->field }}" 
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
                                            @else
                                                <select 
                                                    class="form-control select2" 
                                                    name="{{ $row->field }}[]" multiple
                                                    id="{{ $row->field }}" 
                                                    @if($row->required == 1) required @endif>
                                                    @php
                                                        $model = app($row->details->model);
                                                        $query = $model::all();
                                                    @endphp
                                                    <option disabled>-- Seleciona un dato --</option>
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
                                        <label calss="control-label" for="{{ $row->field }}">{{ $row->display_name }}</label>
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
                                                id="{{ $row->field }}" 
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
                    </div>
                    {{-- <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">{{ __('voyager::generic.save') }}</button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div> 

  
<div class="modal modal-info fade" tabindex="-1" id="default_modal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <div id="title_modal"></div>
            </div>
            <div class="modal-body">
                <div id="modal_body"></div>
            </div>
            <div class="modal-footer">
                <div id="modal_footer"></div>
            </div>
        </div>
    </div>
</div>
@stop
@section('javascript')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>    
        $('document').ready(function () {
            
            $("#myform").validate({
                errorPlacement: function(error, element) {
                // Append error within linked label
                $( element )
                    .closest( "form" )
                        .find( "label[for='" + element.attr( "id" ) + "']" )
                            .append( error );
                },
                errorElement: "span",
            });

            $('.toggleswitch').bootstrapToggle();

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('[data-toggle="tooltip"]').tooltip();

        });

        //eventos ----------------
        $('#save').click(function(){
            Swal.fire({
                title: 'Guardando Datos',
                text: "Estas Seguto de Realizar la accion y Volver al Listado completo ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                }).then((result) => {
                if (result.value) {
                  $('#myform').submit();
                }
            })
        });

        $('#status').change(function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                icon: 'info',
                title: 'Cambio de estado a: '+this.checked
            })
        });

        $('#type').change(function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                icon: 'info',
                title: 'Cambio de tipo: '+$(this).val()
            })
        });


        //Acciones y Eventos del Teaclado
        $(window).bind('keydown', function(event) {
            if(event.ctrlKey || event.metaKey) {
            switch (String.fromCharCode(event.which).toLowerCase()) {
            case 'q':
                event.preventDefault();
                Swal.fire({
                    title: 'Guardando Datos',
                    text: "Estas Seguto de Realizar la accion y Volver al Listado completo ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    }).then((result) => {
                    if (result.value) {
                    $('#myform').submit();
                    }
                })
                break;
            case 'y':
                event.preventDefault();
               
              
                break;
            case 'i':
                event.preventDefault();
               
                break;
            }
            }
        });







  
    </script>
@endsection