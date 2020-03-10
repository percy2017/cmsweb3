@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }} - {{-- {{ $product->name }} --}}
    </h1>
    <a href="{{ route('voyager.boxes.index') }}" class="btn btn-warning">
        <span class="glyphicon glyphicon-list"></span>&nbsp;
        {{ __('voyager::generic.return_to_list') }}
    </a>
   
    {{-- <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
    </a> --}}
</div>
@stop
@section('css')
@stop

@section('content')
    <div class="page-content container-fluid">
            @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary panel-bordered">
                    <div class="panel-body">
                    <form action="{{ route('boxe.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="" >
                            <div class="form-group col-md-6">
                                <label>Titulo</label>
                                <input type="text"  class="form-control" placeholder="enter" name="title">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Monto Inicial</label>
                                <input type="number" class="form-control" placeholder="enter numero" name="start_amount" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Saldo</label>
                                <input type="number" class="form-control" placeholder="enter numero" name="balance" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Estado</label>
                                <input type="checkbox"  name="vehicle1" class="toggleswitch">
                                
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 
@stop