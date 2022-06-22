@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/admin/dashboard.css')}}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('order.index')}}">
                <div class="card">
                    <img class="card-img-top" 
                    src="{{ asset('images/orders.svg') }}" 
                    alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">
                        <button type="button" class="btn btn-primary">
                            Órdenes de compra
                        </button>                            
                      </h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
