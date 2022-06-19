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
                        <th>Fecha creacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('admin.orders.detail', base64_encode($order->id.";".$order->created_at.";".$order->user_id))}}">
                                    <button type="button" class="btn btn-primary">Ver detalle</button>
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
