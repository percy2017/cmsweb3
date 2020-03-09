@extends('voyager::master')
@php
$box=Modules\CashFlow\Entities\Box::where('id', $box_id)->first();
@endphp
@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural')) 

@section('page_header')

     <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }} - {{ $box->title }}
        </h1>
       
        <a href="{{ route('voyager.boxes.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
       @if ($box->status)
        <a href="{{ route('box_close', $box_id) }}" class="btn btn-dark">
            <span class="voyager-lock"></span>&nbsp;
            Cerar Caja
        </a>
       @else
       <a href="#" class="btn btn-default">
         <span class="voyager-lock"></span>&nbsp;
         Cerar Caja
        </a>
       @endif
        
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsibe">
                                    <h5 class="text-center">INGRESOS</h5>
                                    @if ($box->status)
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#IngresosModal">
                                        Nuevo
                                     </button>
                                    @else
                                    <button type="button" class="btn btn-default btn-sm">
                                        Nuevo
                                     </button>
                                    @endif
                                    
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Fecha de Creación</th>
                                                <th scope="col">Concepto</th>
                                                <th scope="col">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $subTotalIngresos=0;
                                        @endphp
                                            @foreach ($ingresos as $item)
                                            <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->concept }}</td>
                                                <td>{{ $item->amount }}</td>
                                                @php
                                                $subTotalIngresos+=$item->amount
                                                @endphp
                                            </tr> 
                                            @endforeach
                                            <tr>
                                                <td colspan="3">
                                                    <h5>SubTotal:</h5>
                                                </td>
                                                <td>
                                                   {{ $subTotalIngresos }}Bs
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsibe">
                                    <h5 class="text-center">EGRESOS</h5>
                                    @if ($box->status)
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#EgresosModal">
                                        Nuevo
                                     </button>
                                    @else
                                    <button type="button" class="btn btn-default btn-sm">
                                        Nuevo
                                     </button>
                                    @endif
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Fecha de Creación</th>
                                                <th scope="col">Concepto</th>
                                                <th scope="col">Monto</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subTotalEgresos=0;
                                            @endphp
                                            @foreach ($egresos as $item)
                                            <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->concept }}</td>
                                                <td>{{ $item->amount }} .Bs</td>
                                               @php
                                                   $subTotalEgresos+=$item->amount
                                               @endphp
                                                
                                            </tr> 
                                            @endforeach
                                            <tr>
                                                <td colspan="3">
                                                    <h5>SubTotal:</h5>
                                                </td>
                                                <td>
                                                {{ $subTotalEgresos }}.Bs
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <h5>Total : {{ $total_literal }}</h5>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div
        <!-- Modal -->
    <div class="modal fade" id="IngresosModal" tabindex="-1" role="dialog" aria-labelledby="IngresosModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ingresos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('seating_storage') }}" method="POST">
                @csrf
                    <input type="hidden" name="box_id" value="{{ $box_id }}">
                    <input type="hidden" name="type" value="INGRESOS">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Monto</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter"">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Concepto</label>
                        <textarea name="concept" id="concept" cols="30" rows="5" class="form-control" ></textarea>
                        {{-- <input type="text" class="form-control" name="concept" id="concept" placeholder="Enter"> --}}
                    </div>
                    
                
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="EgresosModal" tabindex="-1" role="dialog" aria-labelledby="EgresosModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Egresos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('seating_storage') }}" method="POST">
                @csrf
                    <input type="hidden" name="box_id" value="{{ $box_id }}">
                    <input type="hidden" name="type" value="EGRESOS">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Monto</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter"">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Concepto</label>
                        <textarea name="concept" id="concept" cols="30" rows="5" class="form-control" ></textarea>
                        {{-- <input type="text" class="form-control" name="concept" id="concept" placeholder="Enter"> --}}
                    </div>
                    
                
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
            </div>
        </div>
        </div>
    </div>
@endsection

@section('javascript')

@stop