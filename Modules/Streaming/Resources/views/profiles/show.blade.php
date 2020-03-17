@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')

     <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }} - {{ $profiles->fullname }}
        </h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_modal">
            <span class="voyager-calendar"></span>&nbsp;
            Renovar
        </a>
        <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#change_modal">
            <span class="voyager-resize-full"></span>&nbsp;
            Cambiar de cuenta
        </a>
         <a href="{{ route('profile_changeStatus', $profiles->id) }}" class="btn btn-danger">
            <span class="voyager-power"></span>&nbsp;
            Dar de Baja
        </a>
        <a href="{{ route('voyager.profiles.index') }}" class="btn btn-warning">
            <span class="voyager-list"></span>&nbsp;
            Volver
        </a>
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
                <div class="panel-body">
                    <div class="row">
                        <div class="col">
                            <h2 class="text-center"> Tiempo Faltante : {{ $profiles->finaldate->DiffForHumans(\Carbon\Carbon::now()) }}</h2>
                            <hr>
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Tipos</th>
                                        <th>Actulizado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($histories as $item)
                                        <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->type}}</td>
                                        <td>{{ $item->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
{{-- Single delete modal --}}
<div class="modal modal-success fade" tabindex="-1" id="add_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Renovar</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('profile_renovation', $profiles->id) }}" id="add_form" method="POST">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Membresia</label>
                        <select class="form-control" name="membership_id">
                            @foreach ($membresias as $item)
                                @if ($item->id === $profiles->membership_id)
                                    <option value="{{ $item->id }}" selected > {{ $item->title   }}</option>
                                @else
                                    <option value="{{ $item->id }}" > {{ $item->title   }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Fecha</label>
                        <input type="datetime-local" class="form-control" name="finaldate">
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   
{{-- Singledeletemodal --}}
<div class="modal modal-success fade" tabindex="-1" id="change_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Cambiar de Cuenta</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('profile_change') }}" method="POST">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <input type="hidden" name="profile_id" value="{{ $profiles->id }}">

                    <div class="form-group">
                        <label>Cuentas</label>
                        <select class="form-control" name="account_id">
                            @foreach ($accounts as $item)
                            @if ($item->id === $profiles->account_id)
                            <option value="{{ $item->id }}" selected > {{ $item->name }}</option>
                            @else
                            <option value="{{ $item->id }}" > {{ $item->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   
@stop
@section('javascripts')

@endsection
