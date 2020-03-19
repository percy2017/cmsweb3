@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')
     <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
        </h1>
    </div>
@stop
@section('css')

@stop
@section('content')
<div class="page-content container-fluid" id="voyagerBreadEditAdd">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-primary panel-bordered">
                <form role="form" action="{{ route('myproducts.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                            <select class="form-control select2" name="{{ $row->details->column }}" @if($row->required == 1) required @endif>
                                                @php
                                                    $model = app($row->details->model);
                                                    $query = $model::all();
                                                @endphp
                                                @foreach($query as $relationshipData)
                                                    <option value="{{ $relationshipData->{$row->details->key} }}">{{ $relationshipData->{$row->details->label} }}</option>
                                                @endforeach
                                            </select>
                                        @break
                                    @case('select_dropdown')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        {{--  {{ dd($row->details) }}  --}}
                                        @if($row->details->relationship)
                                            @php
                                                $data=$row->details->relationship->{'model'}::all();
                                                $dataj = json_encode($data);
                                                $key=$row->details->relationship->{'key'};
                                                $label=$row->details->relationship->{'label'};
                                            @endphp
                                            <select class="form-control select2" name="{{ $row->field }}" id="{{ $row->field }}" @if($row->required == 1) required @endif>
                                                @foreach ($data  as $item)
                                                    <option value="{{ $item->$key }}">{{ $item->$label }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-control select2" name="{{ $row->field }}" @if($row->required == 1) required @endif>
                                                @foreach ($row->details->options  as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @break
                                    @case('text')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}" placeholder="{{ $row->field }}">
                                        @break
                                   @case('number')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <input type="number" class="form-control" name="{{ $row->field }}" type="number" @if($row->required == 1) required @endif @if(isset($options->min)) min="{{ $options->min }}" @endif @if(isset($options->max)) max="{{ $options->max }}" @endif step="{{ $options->step ?? 'any' }}" placeholder="{{ old($row->field, $options->placeholder ?? $row->getTranslatedAttribute('display_name')) }}" value="{{ old($row->field, $dataTypeContent->{$row->field} ?? $options->default ?? '') }}">
                                        @break
                                    @case('text_area')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <textarea @if($row->required == 1) required @endif class="form-control" name="{{ $row->field }}" rows="{{ $options->display->rows ?? 5 }}">{{ old($row->field, $dataTypeContent->{$row->field} ?? $options->default ?? '') }}</textarea>
                                        @break
                                    @case('timestamp')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <input @if($row->required == 1) required @endif type="datetime" class="form-control datepicker" name="{{ $row->field }}" value="@if(isset($dataTypeContent->{$row->field})){{ \Carbon\Carbon::parse(old($row->field, $dataTypeContent->{$row->field}))->format('m/d/Y g:i A') }}@else{{old($row->field)}}@endif">
                                        @break
                                    @case('rich_text_box')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <textarea class="form-control richTextBox" name="{{ $row->field }}" id="richtext{{ $row->field }}"></textarea>
                                        @break
                                    @case('multiple_images')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <input type="file" name="{{ $row->field }}[]" multiple="multiple" accept="image/*">

                                        @break
                                    @case('checkbox')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <br>
                                           
                                            <?php $checked = $row->details->checked ?>
                                            {{--  @if(isset($row->details->on) && isset($row->details->off))  --}}
                                                <input type="checkbox" name="{{ $row->field }}" class="toggleswitch"
                                                    data-on="{{ $row->details->on }}" {!! $checked ? 'checked="checked"' : '' !!}
                                                    data-off="{{ $row->details->off }}">
                                            {{--  @else
                                                <input type="checkbox" name="{{ $row->field }}" class="toggleswitch"
                                                    @if($checked) checked @endif>
                                            @endif  --}}
                                        
                                        @break
                                    @endswitch                                   
                               @endif
                                
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">{{ __('voyager::generic.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

@stop
@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });

        $('#category_id').change(function(){
            $('#category_id').select2('destroy');
            //let datos = head ? `<option value="">${head}</option>` : '';
           
            alert(JSON.parse('{{ json_encode($data) }}'));
            if(data.length>0){
                data.forEach(item => {
                    datos += `<option value="${item.id}">${item.nombre}</option>`;
                });
            }
            $('#select-'+id).html(datos);
            $('#select-'+id).val(option_active);
            $(`#select-${id}`).select2();
            alert($(this).val());

        })

    </script>
@endsection