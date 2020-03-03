@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
            - {{ $page->name }}
        </h1>
        <a href="{{ route('voyager.pages.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </div>
@stop

@section('css')

@endsection
@section('content')
    <div class="page-content container-fluid" id="voyagerBreadEditAdd">
        @include('voyager::alerts')
        <div class="row">
            @foreach ($blocks as $block)
                <div class="col-md-12">
                    <div class="panel panel-primary panel-bordered">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title panel-icon"><i class="voyager-bread"></i>{{ $block->title }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse"></a>
                            </div>
                           
                        </div>

                        <div class="panel-body">
                            <form action="{{ route('block_update', $block->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="panel panel-success text-center">
                                    <h3>{{ $block->description }}</h3>
                              
                                        <a href="{{ route('block_move_up', $block->id) }}">
                                            <i class="sort-icons fa-lg voyager-sort-asc"></i>
                                        </a>
                                        <a href="{{ route('block_move_down', $block->id) }}">
                                            <i class="sort-icons fa-lg voyager-sort-desc"></i>
                                        </a>
                                </div>
                                
                                {{-- <div class="col-md-offset-3 col-md-6">
                                    <input type="number" min="1" class="form-control" name="position" value="{{ $block->position }}" />
                                </div> --}}
                                <div class="col-md-12">
                                    <hr />
                                </div>
                            
                            
                                @foreach (json_decode($block->details, true) as $item => $value)
                                    @switch($value['type'])
                                        @case('text')
                                            <div class="form-group col-md-{{ $value['width'] }}">
                                                <label>{{ $value['label'] }}</label>
                                                <input type="text" class="form-control" name="{{ $value['name'] }}" placeholder="" value="{{ $value['value'] }}">
                                            </div>
                                            @break
                                        @case('text_area')
                                            <div class="form-group col-md-{{ $value['width'] }}">
                                                <label>{{ $value['label'] }}</label>
                                                <textarea class="form-control" name="{{ $value['name'] }}" rows="3">{{ $value['value'] }}</textarea>
                                            </div>
                                            @break
                                        @case('image')
                                            <div class="form-group col-md-{{ $value['width'] }}">
                                                <label>{{ $value['label'] }}</label>
                                                <a href="#" class="voyager-x remove-single-image" style="position:absolute;">Delete</a>
                                     
                                                <img src="{{ Voyager::Image($value['value']) }}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                                <input type="file" value="{{ $value['value'] }}" name="{{ $value['name'] }}" accept="image/*">
                                                {{--  <input type="hidden" name="{{ $value['name'] }}-aux" value="{{ $value['value'] }}" />  --}}
                                            </div>
                                            @break
                                        @case('select_dropdown')
                                            <div class="form-group col-md-{{ $value['width'] }}">
                                                @php
                                                    $miarray = [
                                                        'fas fa-cogs blue-text',
                                                        'fas fa-book blue-text',
                                                        'fas fa-users blue-text',
                                                        'fas fa-tablet-alt blue-text',
                                                        'fas fa-level-up-alt blue-text',
                                                        'fas fa-phone blue-text',
                                                        'far fa-object-group blue-text',
                                                        'fas fa-rocket blue-text',
                                                        'fas fa-cloud-upload-alt blue-text',
                                                        'fas fa-home blue-text',
                                                        'fas fa-users white-text',
                                                        'fas fa-chart-bar blue-text',
                                                        'far fa-calendar-alt mr-2'
                                                    ];
                                                @endphp
                                                <label>{{ $value['label'] }}</label>
                                                <select class="form-control select2" name="{{ $value['name'] }}">
                                                    @foreach ($miarray as $item)
                                                        <option value="{{ $item }}" @if($value['value'] === $item)selected="selected"@endif>
                                                            {{ $item }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @break
                                        @case('space')
                                            <div class="col-md-12">
                                                <hr />
                                            </div>
                                        @break
                                        @case('number')
                                            <div class="form-group col-md-{{ $value['width'] }}">
                                                <label>{{ $value['label'] }}</label>
                                                <input type="number" class="form-control" name="{{ $value['name'] }}"  placeholder="" value="{{ $value['value'] }}">
                                            </div>
                                        @break
                                    @endswitch
                                @endforeach
                                <div class="form-group col-md-12">
                                    <hr />
                                </div>
                                
                                <div class="form-group text-center col-md-12">
                                    <button type="submit" class="btn btn-primary"><i class="voyager-edit"></i> Guardar este Blocke</button>
                                    <a href="{{ route('block_delete', $block->id) }}" class="btn btn-danger"><i class="voyager-trash"></i> Eliminar este Blocke</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop



@section('javascript')

@endsection