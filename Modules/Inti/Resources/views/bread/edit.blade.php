@can('edit', app($dataType->model_name))
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-dark panel-bordered">
                    <div class="form-group text-center">
                        <h4>
                            <i class="voyager-edit"></i> Editar: {{ $dataType->display_name_singular }}
                        </h4>
                        <hr/>
                    </div>
                    <form class="myform" role="form" action="{{ route('voyager.'.$dataType->name.'.update', $data->id) }}" id="myform" method="POST" enctype="multipart/form-data">
                        {{ method_field("PUT") }}
                        {{ csrf_field() }}
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
                                            @if($row->details->{'type'} == 'belongsTo')
                                                    <select 
                                                        class="form-control select2" 
                                                        name="{{ $row->details->{'column'} }}"
                                                        id="{{ $row->details->{'column'} }}" 
                                                        @if($row->required == 1) required @endif>
                                                        @php
                                                            $model = app($row->details->model);
                                                            $query = $model::all();
                                                            $key = $row->details->column;
                                                        @endphp
                                                        <option disabled>-- Seleciona datos --</option>
                                                        @foreach($query as $relationshipData)
                                                            <option value="{{ $relationshipData->{$row->details->key} }}" @if($relationshipData->{$row->details->key}==$data->$key) selected @endif>{{ $relationshipData->{$row->details->label} }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select 
                                                        class="form-control select2" 
                                                        name="{{ $row->field }}[]" multiple
                                                        id="{{ $row->field }}">
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
                                                        <option value="{{ $item }}" @if($item==$data->$myfield) selected @endif>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @break
                                        @case('text')
                                            <label class="control-label" for="{{ $row->field }}"  id="{{ $row->field }}">{{ $row->display_name }}</label>
                                            @if(isset($row->details->tooltip))
                                                <span class="voyager-question"
                                                aria-hidden="true"
                                                data-toggle="tooltip"
                                                data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                                title="{{ $row->details->tooltip->{'message'} }}"></span>
                                            @endif
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                name="{{ $row->field }}" 
                                                id="{{ $row->field }}" 
                                                value="{{ $data->$myfield }}">
                                            @break
                                        @case('password')
                                            <label class="control-label" for="{{ $row->field }}"  id="{{ $row->field }}">{{ $row->display_name }}</label>
                                            @if(isset($row->details->tooltip))
                                                <span class="voyager-question"
                                                aria-hidden="true"
                                                data-toggle="tooltip"
                                                data-placement="{{ $row->details->tooltip->{'ubication'} }}"
                                                title="{{ $row->details->tooltip->{'message'} }}"></span>
                                            @endif
                                            <input 
                                                type="password" 
                                                class="form-control" 
                                                name="{{ $row->field }}" 
                                                id="{{ $row->field }}" 
                                                value="{{ $data->$myfield }}">
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
                                                value="{{ $data->$myfield }}">
                                            
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
                                                id="{{ $row->field }}">{{ $data->$myfield }}</textarea>
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
                                                value="{{ $data->$myfield }}">
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
                                                class="ckeditor" 
                                                name="{{ $row->field }}" 
                                                id="{{ $row->field }}">{!! htmlspecialchars_decode($data->$myfield) !!}</textarea>
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
                                            <br/>
                                            <?php $checked = $data->$myfield ?>
                                           
                                            <input 
                                                type="checkbox" 
                                                name="{{ $row->field }}" 
                                                id="{{ $row->field }}" 
                                                class="toggleswitch" 
                                                data-on="{{ $row->details->on }}" {!! $checked ? 'checked="checked"' : '' !!} 
                                                data-off="{{ $row->details->off }}">
                                            @break
                                    @endswitch        
                            
                                </div>
                            @endforeach
                        
                        </div>
                        <div class="form-group text-center">
                            <hr/>
                            <button type="submit" id="button_submit" class="btn btn-sm  btn-primary"><i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}</button>
                            <button type="button" onclick="ajax('{{ route('voyager.'.$dataType->name.'.show', $dataType->id) }}', 'get')" class="btn btn-sm btn-success"><i class="voyager-double-left"></i>Cancelar</button>
                        </div>
                        
            
                        
                    </form>
                </div>
            </div>
        </div>
    </div> 
@else
  <div class="page-content edit-add container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
            <div class="panel-body text-center"> 
              <h3>No tiene los permisos, para Editar</h3>
              <code>Consulte con el administrador de Sistema, para realizar la accion</code>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endcan


<script>

    $('.form-group input[type=datetime]').each(function (idx, elt) {
        let id = '#'+elt.id; 
        $(id).datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
    $('.form-group select').each(function (idx, elt) {
        let id = '#'+elt.id;
        $(id).select2();

        $(id).change(function(){
            message('success', 'Update - '+$(this).val());
        });
    });

    $('.toggleswitch').bootstrapToggle();

    var frm = $('#myform');
    $("#button_submit").click(function() {
        event.preventDefault();
                
        Swal.fire({
        title: 'Actualizando',
        text: "Estas segur@ de realizar la accion ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
            $('.form-group .ckeditor').each(function (idx, elt) {
                CKEDITOR.instances[elt.id].updateElement();
            });
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: frm.attr('action'),
                    data: new FormData($('#myform')[0]),
                    contentType : false,
                    processData : false,
                    success: function (data) {
                       
                        if(data.error)
                        {
                            let message='';
                            $.each(data.error, function(i,item){
                                message = message+'*'+item+'\n';
                            })
                            Swal.fire({
                                icon: 'error',
                                title: message,
                            })
                        }else{
                            $('#ajax_body').html(data);
                            message('success', 'Dato actualizado correctamente.')
                        }
                    },
                    error: function (data) {
                        $('#ajax_body').html('<div class="text-center"><h3><code>Ups, Ocurrio un error inesperado <br /><br /> 1.-Revise su configuracion <br /><br /> 2.-Vuela a intentarlo una vez mas <br /><br /> 3.-Consulte con el soporte tecnico</code></h3></div>'); 
                        message('error', 'Error en la accion')
                    },
                });
            }else{
                message('info', 'accion declinada');
            }
        })
    });

     $('.form-group .ckeditor').each(function (idx, elt) {
        CKEDITOR.replace(elt.id);
    });
</script>
