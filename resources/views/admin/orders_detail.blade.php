@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{asset('css/admin/general.css')}}">
<div class="container order-detail">
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.orders.index') }}">
                <img src="{{asset('images/arrow-return-left.svg')}}" alt=""> 
                Volver al listado
            </a>
        </div>
    </nav>
    @include('forms.order_detail')
</div>
@endsection
