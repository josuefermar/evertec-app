<link rel="stylesheet" href="{{asset('css/forms/checkout.css')}}">

<form id="checkout-form" action="{{route('resume')}}" method="post">

    @csrf
    <input type="hidden" 
        name="product_id" 
        value="{{$data['params']['product_id']}}">

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-2 row-element">
            <div class="card">
                <img class="card-img-top" 
                src="{{ asset('images/products/'.$data['product']->image_name) }}" 
                alt="{{$data['product']->image_name}}">
                <div class="card-body">
                    <h5 class="card-title">{{$data['product']->name}}</h5>
                    <p class="card-text">
                        ${{number_format($data['product']->price, 0, ',', '.')}} 
                        <small>COP</small>
                    </p>
                    <span>
                        Cantidad: 
                        <input class="form-control" 
                            type="number" 
                            name="quantity" 
                            id="quantity" 
                            value="1" 
                            min="1" 
                            max="99">
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-2 row-element">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Ingresa tus datos para continuar con la compra
                    </h5><br>
                    <div class="form-group mb-2">
                        <label for="name">Nombre</label>
                        <input class="form-control" 
                            type="text" 
                            name="name" 
                            id="name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Correo</label>
                        <input class="form-control" 
                            type="email" 
                            name="email" 
                            id="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="mobile">Celular</label>
                        <input class="form-control" 
                            type="number" 
                            name="mobile" 
                            id="mobile">
                    </div>
                    <div class="form-group submit-group">
                        <button type="submit" 
                            class="btn btn-primary purchase-button">
                            Comprar
                        </button>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{asset('js/checkout.js')}}"></script>