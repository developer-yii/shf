@extends('layouts.app')
@php
    $baseUrl = asset('product_images')."/";
@endphp
@section('title','User | Products')
@section('content')
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Filter By</label>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
                                <div class="dropdown-menu">
                                    @foreach(getCategories() as $category)
                                        <a class="dropdown-item" href="{{ route('user.product', ['id' => $category->id]) }}">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="page-title">Products @if($productArtName) - {{ $productArtName }} @endif</h4>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <img src="{{ $product->getImageUrl() }}" class="card-img-top product-img" alt="{{ $product->name }}" title="{{ $product->name }}">
                    <div class="card-body text-center product">
                        <h5 class="card-title">{{ $product->name }}
                            @if($product->tension)
                                - {{ $product->tension}}
                            @endif
                        </h5>
                        <h5 class="card-title">
                            <i class="uil uil-dollar-alt"></i>{{ $product->price}}
                            @if( $product->total_volume)
                            / {{ $product->total_volume}}{{ getUnitByVolumeType($product->volume_type)['unit'] }}
                            @endif
                        </h5>
                        <a href="{{ route('user.product.detail', ['id' => $product->id]) }}" class="btn view-cart-button btn-info">View Details</a>

                        @php
                            $cartItem = $cart[$product->id] ?? null;
                            $quantity = $cartItem['quantity'] ?? 0;
                        @endphp

                        <div class="product d-inline">
                            @if ($quantity == 0)
                                <a href="#" data-product-id="{{ $product->id }}" class="btn add-cart-button btn-primary add-to-cart-btn">
                                    <i class="mdi mdi-cart me-1"></i>Add to Cart
                                </a>
                            @endif
                                <input type="number" min="1" value="{{ $quantity }}" class="quantity update-qty" data-product-id="{{ $product->id }}" placeholder="Qty" style="width: 90px; {{ $quantity == 0 ? 'display: none;' : '' }}">
                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->
        @endforeach
    </div>
    <!-- end page title -->

    <div class="row float-right">
        <div class="col-12">
            {!! $products->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
<!-- container -->
@endsection