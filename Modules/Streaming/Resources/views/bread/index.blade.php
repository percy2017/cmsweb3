

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
  
          @foreach ($menuItems as $item)
              @if($item->title == 'divider')
                <li role="separator" class="divider"></li>
              @elseif($item->title == 'setting')
                <li><a href="{{ route('voyager.bread.edit', $dataType->slug) }}" target="{{ $item->target }}">Configuracion</a></li>
              @else
                <li><a href="#" onclick="ajax('{{ url($item->url) }}', 'get')" target="{{ $item->target }}"> {{ $item->title }}</a></li>
              @endif
              
          @endforeach
          
        
          
        </ul>
      </div>
  </div>
@stop

@section('css')
  <style>
      .myform div label span.error { color: red; }
  </style>
@stop

@section('content')
  <div id=ajax_body></div>  

  <!-- Modal -->
  <div class="modal modal-info fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div id="modal_title"></div>
        </div>
        <div class="modal-body">
          <div id="modal_body"></div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('javascript')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
      $(document).ready(function () {
        ajax('{{ route('voyager.'.$dataType->name.'.show', $dataType->id) }}', 'get')
        
      });


      //events ------------------
      //-------------------------

      $(window).bind('keydown', function(event) {
        if(event.ctrlKey || event.metaKey) {
            switch (String.fromCharCode(event.which).toLowerCase()) {
            case 'q':
                event.preventDefault();
                  
                break;
            case 'y':
                event.preventDefault();
            
                break;
            case 'i':
                event.preventDefault();
                
                break;
            }
        }
      });


      //funciones ------------------
      //----------------------------
      function ajax(urli, action)
      {
        switch (action) {
          case 'get':
            <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
            $('#ajax_body').html('<div id="voyager-loader"><img src="@if($admin_loader_img == '') {{ voyager_asset('images/logo-icon.png') }} @else {{ Voyager::Image(setting('admin.loader')) }}@endif"></div>');
            
            $.ajax({
              type: 'get',
              url: urli,
              success: function (response) {
               
                  $('#ajax_body').html(response);
              },
              error: function(response){
                message('error', 'error al cargar los datos')
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
                  type: 'delete',
                  url: urli,
                  data: {
                      "_token": $("meta[name='csrf-token']").attr("content")
                  },
                  success: function (response) {
                  
                    $('#ajax_body').html(response);
                  },
                  error: function(response){
                    message('error', 'error al cargar los datos')
                  }
                });
              }else{
                message('info', 'accion declinada');
              }
            })

            break;
          default:
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
          })
          Toast.fire({
          icon: type,
          title: message
        })

      }

    </script>
@stop



