@php
    $baseUrl = asset('frontend') . '/';
    $hasProducts = false;
    foreach ($groupedProducts as $group) {
        if (count($group['products']) > 0) {
            $hasProducts = true;
            break;
        }
    }
@endphp
@extends('layouts.app-frontend')

@section('title', 'Product')
@section('content')
    <!-- Main Container Starts -->
    <div class="main-container">

        <div class="products-section">
            <div class="product-top-bg"></div>

            <div class="container">
                <div class="products-wrap ">
                    <h3 class="head-3">Recombinant human growth hormone</h3>
                    @if (!$hasProducts)
                        <div class="product-category no-border">
                            <div class="f-row f-4 f-1600-3 f-1366-2 f-990-1">
                                <div class="f-col">
                                    <h1>No products available.</h1>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($groupedProducts as $group)
                            @if (count($group['products']) > 0)
                                @foreach ($group['products'] as $product)
                                    @php
                                        $getunit = getUnitByVolumeType($product->volume_type);
                                    @endphp
                                    <div class="product-category no-border">
                                        <div class="f-row f-4 f-1600-3 f-1366-2 f-990-1">
                                            <div class="f-col">
                                                <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                                    <div class="product-box">
                                                        <h4>{{ $product->name }}</h4>
                                                        <div class="product-specs">
                                                            @if ($product->tension)
                                                                <div class="specification">
                                                                    <div class="specs-icon">
                                                                        <img src="{{ $baseUrl }}img/spec-icon.svg"
                                                                            alt="" class="img-icon-w-32">
                                                                    </div>
                                                                    <span>{{ $product->tension }}</span>
                                                                </div>
                                                            @endif
                                                            @if ($product->total_volume)
                                                                <div class="specification">
                                                                    <div class="specs-icon mlr-3">
                                                                        <img src="{{ $getunit['image'] }}" alt=""
                                                                            class="img-icon-w-32">
                                                                    </div>
                                                                    <span>
                                                                        {{ $product->total_volume }} {{ $getunit['unit'] }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            <div class="specification">
                                                                <div class="specs-icon mlr-3">
                                                                    <img src="{{ getArtIcon($group['productArt']->name)['image'] }}"
                                                                        alt="" class="img-icon-w-32">
                                                                </div>
                                                                <span>{{ $group['productArt']->name }}</span>
                                                            </div>
                                                            <div class="specification" style="width: 100%;">
                                                                <div class="specs-icon mlr-3">
                                                                    <img src="{{ $baseUrl }}img/spec-icon-4.svg"
                                                                        alt="" class="img-icon-w-32">
                                                                </div>
                                                                <span class="m-l-5">
                                                                    {{ $product->productUse->use }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="product-bottom-section">
                <div class="container">
                    <div class="bottom-box">
                        <h3 class="head-3 center">Check authenticity.</h3>
                        <div class="bottom-btns">
                            <a href="{{ route('frontend.authenticity') }}" class="button blue">Authenticate Product</a>
                        </div>

                        <div class="bottom-image">
                            <img src="{{ $baseUrl }}img/products-bottom.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
