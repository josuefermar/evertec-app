@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-2">
            <a href="#">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                    src="{{ asset('images/orders.svg') }}" 
                    alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Ordenes</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-2">
            <a href="#">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                    src="{{ asset('images/orders.svg') }}" 
                    alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Usuarios</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
