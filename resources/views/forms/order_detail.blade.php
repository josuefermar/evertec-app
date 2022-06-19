<link rel="stylesheet" href="{{asset('css/forms/order_detail.css')}}">

<form action="{{route('order.pay')}}" method="post">
    @csrf
    <input type="hidden" name="order_id" value="{{$data['order']->id}}">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-2 row-element">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title justify-content-center">
                        <div>DETALLE DE LA ORDEN </div>
                        @switch($data['order']->status)
                        @case('CREATED')
                            <div class="alert alert-warning" role="alert">
                                creada
                            </div>
                            @break
                        @case('PAYED')
                            <div class="alert alert-success" role="alert">
                                pagada
                            </div>
                            @break
                        @case('REJECTED')
                            <div class="alert alert-danger" role="alert">
                                rechazada
                            </div>
                            @break
                        @endswitch
                    </h5>
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
                    
                    @if ($data['view_name'] == 'order.detail' && 
                        ($data['order']->status == 'CREATED' || 
                        $data['order']->status == 'REJECTED'))
                        <div class="form-group submit-group">
                            <button type="submit" 
                                class="btn btn-primary purchase-button">
                                Proceder al pago
                            </button>                            
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>