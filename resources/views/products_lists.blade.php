<style>
    .product-card a{
        color: black;
        text-decoration: none;
    }
    .product-card a .card-title{
        font-weight: bold !important;
    }
    .card-img-top{
        width: 210px !important;
        margin: auto;
        margin-top: 5%;
        margin-bottom: 5%;
    }
    .product-card {
        transition: transform .2s;
        width: 290px;
        height: 575px;
    }
    .product-card:hover {
        transform: scale(1.1); 
    }

    .purchase-button{
        background-color: #FF6C0C;
        border-color: #FF6C0C;
    }

    .purchase-button:hover{
        background-color: #E55B00;
        border-color: #E55B00;
    }

    .purchase-form{
        text-align: center;
    }
</style>
<div class="row justify-content-center">
    
    @foreach ($products as $product)        
        <div class="product-card col-md-4 col-sm-2">
            <a href="#">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" 
                    src="{{ asset('images/products/'.$product->image_name) }}" 
                    alt="{{$product->image_name}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">${{number_format($product->price, 0, ',', '.')}} <small>COP</small></p>
                        <form class="purchase-form" action="{{route('checkout')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <button type="submit" class="btn btn-primary purchase-button">Comprar</button>                            
                        </form>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>