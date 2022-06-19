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

    .text-resume{
        text-align: left;
        padding-left: 3%;
        margin-bottom: 1%;
    }
</style>

<form action="{{route('order.create')}}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{$data['params']['product_id']}}">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-2 row-element">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">RESUMEN DE COMPRA</h5>
                    <p class="card-text text-resume"><strong>Nombre:</strong> {{$data['params']['name']}}</p>
                    <p class="card-text text-resume"><strong>Correo:</strong> {{$data['params']['email']}}</p>
                    <p class="card-text text-resume"><strong>Celular:</strong> {{$data['params']['mobile']}}</p>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center" >Producto</th>
                                <th style="text-align: center">Cantidad</th>
                                <th style="text-align: center">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img width="30px" src="{{ asset('images/products/'.$data['product']->image_name) }}" alt="">
                                </td>
                                <td>
                                    {{$data['product']->name}}
                                </td>
                                <td style="text-align: center">
                                    {{$data['params']['quantity']}}
                                </td>
                                <td style="text-align: center">
                                    ${{number_format($data['product']->price, 0, ',', '.')}} <small>COP</small>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: end"><strong>TOTAL</strong></td>
                                <td>${{number_format($data['product']->price * $data['params']['quantity'], 0, ',', '.')}} <small>COP</small></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="form-group mb-2" style="margin: 5%">
                        <button type="button" class="btn btn-primary purchase-button">Proceder al pago</button>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>