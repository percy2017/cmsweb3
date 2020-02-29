@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')

     <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }} - {{ $product->name }}
        </h1>
       
        <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
        </a>
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
                        <div class="table-responsive">
                            {{-- <table id="dataTable" class="table table-hover">
                                <caption>List of Details</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">created_at</th>
                                        <th scope="col">acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($details as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id}}</th>
                                        <td>{{ $item->title }} </td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->created_at }}</td>
                                    
                                        <td>    
                                            <a href="#" onclick="#" class="btn btn-warning">
                                                <i class="voyager-pen"></i>
                                            </a>
                                             <a href="#" onclick="#" class="btn btn-danger">
                                                <i class="voyager-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div
@endsection

@section('javascript')
@stop
