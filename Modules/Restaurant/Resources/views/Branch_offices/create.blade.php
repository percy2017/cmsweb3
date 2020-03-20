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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <style>
            #map {
                height: 340px;
            }
        </style>
@stop
@section('content')
<div class="page-content container-fluid" id="voyagerBreadEditAdd">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
             <div class="panel panel-primary panel-bordered">
                <form role="form" action="{{ route('mybranch_offices.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}" id="{{ $row->field }}" placeholder="{{ $row->field }}">
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
                                    @case('Map')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                         <div id="map"></div>   
                                        @break
                                    @case('hidden')                     
                                        <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}" id="{{ $row->field }}" placeholder="{{ $row->field }}">  
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
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <script>
var map;
var marcador;

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
            map = L.map('map').fitWorld();
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 20,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox.streets'
            }).addTo(map);
            function onLocationFound(e) {
        $('#latitud').val(e.latlng.lat);
        $('#longitud').val(e.latlng.lng);
        marcador =  L.marker(e.latlng, {
                    draggable: true
                }).addTo(map)
                .bindPopup("Localización actual").openPopup()
                .on('drag', function(e) {
                    $('#latitud').val(e.latlng.lat);
                    $('#longitud').val(e.latlng.lng);
                });
        map.setView(e.latlng);
    }

    function onLocationError(e) {
        alert(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate();
    map.setZoom(13);
        });
        
    </script>
@endsection