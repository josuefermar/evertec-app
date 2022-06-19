<style>
    .card .card-title{
        font-weight: bold !important;
    }
    .card-img-top{
        width: 210px !important;
        margin: auto;
        margin-top: 5%;
        margin-bottom: 5%;
    }
    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        text-align: -webkit-left !important;
    }

    .row-element{
        text-align: -webkit-center;
    }

    .form-control{
        width: 94%;
    }

    .purchase-button{
        background-color: #FF6C0C;
        border-color: #FF6C0C;
    }

    .purchase-button:hover{
        background-color: #E55B00;
        border-color: #E55B00;
    }

    .card{
        width: 30rem;
    }

    .invalid-feedback{
        display: block
    }

    .error{
        color: red;
    }

    @media (max-width: 600px) {
        .card{
            width: 19rem;
        }
    }
</style>

<form id="checkout-form" action="{{route('resume')}}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{$data['params']['product_id']}}">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-2 row-element">
            <div class="card">
                <img class="card-img-top" 
                src="{{ asset('images/products/'.$data['product']->image_name) }}" 
                alt="{{$data['product']->image_name}}">
                <div class="card-body">
                    <h5 class="card-title">{{$data['product']->name}}</h5>
                    <p class="card-text">${{number_format($data['product']->price, 0, ',', '.')}} <small>COP</small></p>
                    <span>
                        Cantidad: <input class="form-control" style="display: inline; width: 15%" type="number" name="quantity" id="quantity" value="1" min="1" max="99">
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-2 row-element">
            <div class="card" style="height: 31rem;">
                <div class="card-body">
                    <h5 class="card-title" style="margin-top: 4%">Ingresa tus datos para continuar con la compra</h5><br>
                    <div class="form-group mb-2" style="text-align: -webkit-left !important; padding-left: 5%">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="form-group mb-2" style="text-align: -webkit-left !important; padding-left: 5%">
                        <label for="email">Correo</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="form-group mb-2" style="text-align: -webkit-left !important; padding-left: 5%">
                        <label for="mobile">Celular</label>
                        <input class="form-control" type="text" name="mobile" id="mobile">
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary purchase-button">Comprar</button>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#checkout-form').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10                        
                }
            },
            messages: {
                name: "El campo es obligatorio.",
                email : "El campo es obligatorio y debe tener formato de email correcto.",
                mobile : "El campo Celular no contiene un formato correcto.",
            }
        });
    });
</script>