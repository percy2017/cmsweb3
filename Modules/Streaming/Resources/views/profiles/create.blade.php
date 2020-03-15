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
                <form role="form" action="{{ route('myprofiles.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="panel-body">
                        @foreach($dataRows as $row)
                            @php
                                $display_options = $row->details->display ?? NULL;
                            @endphp
                            <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                {{ $row->slugify }}
                                @switch($row->type)
                                    @case('relationship')
                                            <select class="form-control select2" name="{{ $row->details->column }}">
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
                                        <select class="form-control select2" name="{{ $row->field }}">
                                            @foreach ($row->details->options as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @break
                                    @case('text')
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        <input @if($row->required == 1) required @endif type="text" class="form-control" name="{{ $row->field }}" placeholder="{{ $row->field }}">
                                        @break
                                    @default
                                        
                                @endswitch
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
@section('javascripts')

@endsection
