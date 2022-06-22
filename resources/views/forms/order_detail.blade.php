<link rel="stylesheet" href="{{asset('css/forms/order_detail.css')}}">

<form action="{{route('order.pay')}}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{$data['order']->id}}">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-2 row-element">
            <div class="card">
                <div class="card-body">
                    <div class="card-title justify-content-center">
                        <h4>DETALLE DE LA ORDEN #{{$data['order']->id}}</h4>
                        @if (in_array($data['order']->status, array('PAYED')))
                            <h5 class="alert alert-success" role="alert">
                                PAGADA
                            </h5>
                        @elseif(in_array($data['order']->status, array('REJECTED', 
                            'FAILED')))
                            <h5 class="alert alert-danger" role="alert">
                                RECHAZADA
                            </h5>
                        @elseif(in_array($data['order']->status, array('PENDING')))
                            <h5 class="alert alert-warning" role="alert">
                                PENDIENTE
                            </h5>
                        @else
                            <h5 class="alert alert-warning" role="alert">
                                CREADA
                            </h5>                            
                        @endif
                    </div>
                    <p class="card-text text-resume"><strong>Nombre:</strong> 
                        {{$data['user']->name}}
                    </p>
                    <p class="card-text text-resume"><strong>Correo:</strong> 
                        {{$data['user']->email}}
                    </p>
                    <p class="card-text text-resume"><strong>Celular:</strong> 
                        {{$data['user']->mobile}}
                    </p>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" >Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img width="30px" 
                                    src="{{ asset('images/products/'.$data['product']->image_name) }}" alt="">
                                </td>
                                <td>
                                    {{$data['product']->name}}
                                </td>
                                <td class="centered">
                                    {{$data['order']->quantity}}
                                </td>
                                <td class="centered">
                                    ${{number_format($data['order']->product_price, 0, ',', '.')}} 
                                    <small>COP</small>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>TOTAL</strong></td>
                                <td>
                                    ${{number_format($data['order']->product_price * $data['order']->quantity, 0, ',', '.')}} 
                                    <small>COP</small>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{$errors->first()}}
                        </div>
                    @endif

                    @guest
                        @if (in_array($data['order']->status, array(
                                'CREATED', 
                                'REJECTED', 
                                'FAILED', 
                                'PENDING'
                            )))
                            <div class="form-group submit-group">
                                <button type="submit" 
                                    class="btn btn-primary purchase-button">
                                    Proceder al pago
                                </button>                            
                            </div>
                        @endif 
                    @endguest
                </div>
            </div>
        </div>
    </div>
</form>