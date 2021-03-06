<link rel="stylesheet" href="{{asset('css/products_list.css')}}">
<div class="row justify-content-center">
    
    @foreach ($products as $product)        
        <div class="product-card col-md-3 col-sm-4">
            <form action="{{route('checkout')}}" 
                            method="post" onclick="$(this).submit();">
                @csrf
                <input 
                                type="hidden" 
                                name="product_id" 
                                value="{{$product->id}}">
                <a href="javascript:void(0);">
                    <div class="card">
                        <img class="card-img-top" 
                            src="{{ asset('images/products/'.$product->image_name) }}" 
                            alt="{{$product->image_name}}"
                        >
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">
                                ${{number_format($product->price, 0, ',', '.')}} 
                                <small>COP</small>
                            </p>
                            

                                <div class="purchase-form">
                                    <button 
                                        type="submit" 
                                        class="btn btn-primary purchase-button">
                                        Comprar
                                    </button>
                                </div>                         
                        </div>
                    </div>
                </a>
            </form>
        </div>
    @endforeach
</div>