@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('css/admin/general.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-2">
            <table class="table">
                <thead>
                    <tr>
                        <th># Orden</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>
                                @if (in_array($order->status, array('PAYED')))
                                    <span class="alert alert-success" role="alert">
                                        PAGADA
                                    </span>
                                @elseif(in_array($order->status, array('REJECTED', 
                                    'FAILED')))
                                    <span class="alert alert-danger" role="alert">
                                        RECHAZADA
                                    </span>
                                @elseif(in_array($order->status, array('PENDING')))
                                    <span class="alert alert-warning" role="alert">
                                        PENDIENTE
                                    </span>
                                @else
                                    <span class="alert alert-warning" role="alert">
                                        CREADA
                                    </span>                            
                                @endif   
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('order.detail', base64_encode($order->id.";".$order->created_at.";".$order->user_id))}}">
                                    <button type="button" class="btn btn-primary">
                                        Ver detalle
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $orders->links() }}
</div>

@endsection
