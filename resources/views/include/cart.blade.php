<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" >
    <i class="mdi mdi-cart"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
</a> 

<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

    <div class="dropdown-item px-3 mt-2">
        <h5 class="m-0">
            <span class="float-right">
                <a href="javascript: void(0);" class="text-dark">
                    @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        Total: <span class="text-info"><i class="mdi mdi-currency-eur"></i> {{ $total }}</span>
                    
                </a>
            </span>
            <i class="mdi mdi-cart"></i> Item <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
        </h5>
    </div>
    <hr>

   <div class="px-3" data-simplebar>
     @if(session('cart'))
        @foreach(session('cart') as $id => $details)
        <a href="{{ route('user.product.detail', $details['id']) }}" class="dropdown-item card shadow-none p-0">                           
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="notify-icon bg-primary">
                        <img src="{{ $cartImageUrl }}/{{ $details['image'] }}"  width="50" height="50" alt="{{ $cartImageUrl }}/{{ $details['image'] }}" title="{{ $cartImageUrl }}/{{ $details['image'] }}" />
                    </div>
                </div>
                <div class="flex-grow-1 text-truncate ms-2 ml-2">
                    <h5 class="noti-item-title fw-semibold font-14">{{ $details['name'] }} </h5>
                    <span class="price text-info"> <i class="mdi mdi-currency-eur"></i>{{ $details['price'] }}</span> x <span class="count"> Qty {{ $details['quantity'] }} = <i class="mdi mdi-currency-eur"></i>{{ $details['price'] * $details['quantity'] }}</span>
                </div>
                <!-- <span class="float-right text-muted remove-from-cart"><i class="mdi mdi-close"></i></span> -->
            </div>
        </a>
         @endforeach
    @endif

   </div>
    <!-- All-->
    @if(session('cart'))
        <div class="text-center mb-2">
            <a href="{{ route('user.cart') }}" class="btn btn-primary"><i class="mdi mdi-cart"></i> View Cart</a>
            <a href="{{ route('user.checkout') }}" class="btn btn-primary"><i class="mdi mdi-cart-plus me-1"></i>Checkout</a>
        </div>
    @else
        <div class="text-center mb-2">
            <b>No any item added in Cart</b>
        </div>
    @endif
</div>