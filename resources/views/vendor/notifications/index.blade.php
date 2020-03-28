@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

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
          
          <li><a href="javascript:;" id="eliminados">Mostrar Elimnados</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="{{ route('voyager.bread.edit', $dataType->slug) }}">Configuracion</a></li>
        </ul>
      </div>
  </div>
@stop

@section('css')
    @livewireStyles
@stop

@section('content')
 

   <div class="modal modal-info fade" tabindex="-1" id="modal_default" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <div id="modal_title"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    
    <script>
        $(document).ready(function () {
            
        });


        //events ------------------
        //events-------------------

        //funciones----------------
        //funciones----------------

        //Socktes----------------
        Echo.channel('home').listen('NewMessage', (e) => {
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
            title: e.message
        })

        });
        //Socktes----------------

    </script>
@stop