@extends('layouts.app')

@section('content')
    <div class="container">
        <nav class="navbar">
            <div class="container">
                @guest
                    <a class="navbar-brand" href="{{route('order.index', base64_encode($data['user']->email)) }}">
                        <img src="{{asset('images/arrow-return-left.svg')}}"> 
                        Volver al listado
                    </a>
                @else
                    <a class="navbar-brand" href="{{ route('order.index') }}">
                        <img src="{{asset('images/arrow-return-left.svg')}}"> 
                        Volver al listado
                    </a>
                @endguest
            </div>
        </nav>
        @include('forms.order_detail')
    </div>
@endsection
