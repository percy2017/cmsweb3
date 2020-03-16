@extends('voyager::master')
@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
        </h1>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#new">
            <i class="voyager-plus"></i> Nuevo
        </button>
    </div>
@stop

@section('content')
  <div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-bordered">
          <div class="panel-body">
            @foreach ($profiles as $item)
                <div class="row">
                  <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <img src="@if($item->avatar){{ Voyager::image($item->avatar) }}@else{{ Voyager::image('users/default.png') }}@endif" alt="{{ $item->fullname }}">
                      <div class="caption">
                        <h3>{{ $item->fullname }}</h3>
                        <p>{{ $item->phone }}</p>
                        <p>{{ $item->statu }}</p>
                        <p>
                          <a href="#" class="btn btn-primary" role="button">Button</a> 
                          <a href="#" class="btn btn-default" role="button">Button</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>  
  </div>



  <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="IngresosModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Perfil
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('account_profiles_save') }}" method="POST">
                @csrf
                <input type="hidden" name="account_id" value="{{ $account->id }}">
                <div class="form-group">
                    <label for="">Menbresia</label>
                    <select class="form-control select2" name="membership_id">
                        @foreach ($memberships as $item)
                            <option value="{{ $item->id }}">{{  $item->title   }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre Completo</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Nombre Completo">
                </div>
                <div class="form-group">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="phone" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="">Fecha Inicio</label>
                    <input type="datetime" class="form-control datepicker" name="startdate">
                </div>
                <div class="form-group">
                    <label for="">Observacion</label>
                    
                    <textarea name="observation" cols="30" rows="3" class="form-control" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
        </div>
    </div>

@stop
@section('javascript')

@endsection