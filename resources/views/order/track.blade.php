@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/order/track.css')}}">

@section('content')
    <div class="container">
        <form id="track-form" action="{{Route('order.search')}}" method="post">
            @csrf
            <div class="col-md-12 col-sm-2 row-element">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Ingresa tus datos para rastrear tus órdenes
                        </h5><br>
                        @if($errors->any())
                            <div class="alert alert-danger" 
                                role="alert">
                                {{$errors->first()}}
                            </div>
                        @endif
                        <div class="form-group mb-2">
                            <label for="email">Correo</label>
                            <input class="form-control" 
                                type="email" 
                                name="email" 
                                id="email">
                        </div>
                        <div class="form-group search-group">
                            <button type="submit" 
                                class="btn btn-primary search-button">
                                Buscar
                            </button>                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="{{asset('js/order/track.js')}}"></script>