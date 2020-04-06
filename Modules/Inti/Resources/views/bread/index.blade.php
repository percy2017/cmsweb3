@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->display_name_plural) 

@section('page_header')
  <div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
    </h1>
    <div class="btn-group">
      <button type="button" class="btn btn-dark"><i class="voyager-tools"></i> <span>Acciones</span></button>
      <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <ul class="dropdown-menu">
        @foreach ($menuItems as $item)
            @if($item->title == 'divider')
              <li role="separator" class="divider"></li>
            @elseif($item->title == 'setting')
              @can('browse', app($dataType->model_name))
                <li><a href="{{ route('voyager.bread.edit', $dataType->slug) }}" target="{{ $item->target }}">Configuracion</a></li>
              @endcan
            @else
              <li><a href="#" onclick="ajax('{{ url($item->url) }}', 'get')" target="{{ $item->target }}"> {{ $item->title }}</a></li>
            @endif
        @endforeach
      </ul>
    </div>
  </div>
@stop

@section('css')
@stop

@section('content')
  <div id=ajax_body></div>  
@stop

@section('javascript')
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
  <script>
    $(document).ready(function () {
      ajax('{{ route('voyager.'.$dataType->name.'.show', $dataType->id) }}', 'get')
    });

    //funciones ------------------
    //----------------------------
    function ajax(urli, action)
    {
      //alert(urli);
      switch (action) {
        case 'get':
          <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
          $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');
          $.ajax({
            type: action,
            url: urli,
            success: function (response) {
                $('#ajax_body').html(response);
            },
            error: function(response){
              $('#ajax_body').html('<div class="text-center"><h3><code>Ups, Ocurrio un error inesperado <br /><br /> 1.-Revise su configuracion <br /><br /> 2.-Vuela a intentarlo una vez mas <br /><br /> 3.-Consulte con el soporte tecnico</code></h3></div>'); 
              message('error', 'error al cargar los datos');
            }
          });
          break;
        case 'delete':
          Swal.fire({
            title: 'Elimando',
            text: 'Estas segur@ de realizar la accion ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.value) {
              <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
              $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');
              $.ajax({
                type: action,
                url: urli,
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                success: function (response) {
                  $('#ajax_body').html(response);
                  message('info', 'Dato eliminado');
                },
                error: function(response){
                  message('error', 'error al cargar los datos');
                }
              });
            }else{
              message('info', 'accion declinada');
            }
          })
          break;
        case 'recovery':
          Swal.fire({
            title: 'Recuperando',
            text: 'Estas segur@ de realizar la accion ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            }).then((result) => {
            if (result.value) {
              <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
              $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');
              $.ajax({
                type: 'get',
                url: urli,
                success: function (response) {
                  $('#ajax_body').html(response);
                  message('success', 'Dato recuperado');
                },
                error: function(response){
                  message('error', 'error al cargar los datos');
                }
              });
            }else{
              message('info', 'accion declinada');
            }
          })
          break;
      }
    }

    function message(type, message)
    {
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
      });
      Toast.fire({
        icon: type,
        title: message
      });
    }
  </script>
@stop



