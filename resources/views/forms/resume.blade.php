<link rel="stylesheet" href="{{asset('css/forms/resume.css')}}">

<form action="{{route('order.create')}}" method="post">

    @csrf
    <input type="hidden" 
        name="product_id" 
        value="{{$data['params']['product_id']}}">
    <input type="hidden" 
        name="name" 
        value="{{$data['params']['name']}}">
    <input type="hidden" 
        name="email" 
        value="{{$data['params']['email']}}">
    <input type="hidden" 
        name="mobile" 
        value="{{$data['params']['mobile']}}">
    <input type="hidden" 
        name="quantity" 
        value="{{$data['params']['quantity']}}">

    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-2 row-element">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">RESUMEN DE COMPRA</h5>
                    <p class="card-text text-resume">
                        <strong>Nombre:</strong> {{$data['params']['name']}}
                    </p>
                    <p class="card-text text-resume">
                        <strong>Correo:</strong> {{$data['params']['email']}}
                    </p>
                    <p class="card-text text-resume">
                        <strong>Celular:</strong> {{$data['params']['mobile']}}
                    </p>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    Producto
                                </th>
                                <th>Cantidad</th>
                                <th>Precio</th>
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
                                <td class="centered">
                                    {{$data['params']['quantity']}}
                                </td>
                                <td class="centered">
                                    ${{number_format($data['product']->price, 0, ',', '.')}} 
                                    <small>COP</small>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <strong>TOTAL</strong>
                                </td>
                                <td>
                                    ${{number_format($data['product']->price * $data['params']['quantity'], 0, ',', '.')}} 
                                    <small>COP</small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="form-group mb-2" style="margin: 5%">
                        <button 
                            type="submit" 
                            class="btn btn-primary purchase-button">
                            Proceder al pago
                        </button>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>