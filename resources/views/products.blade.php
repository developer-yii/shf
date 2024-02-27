@php
    $baseUrl = asset('frontend')."/";
    $hasProducts = false;
    foreach($groupedProducts as $group) {
        if(count($group['products']) > 0) {
            $hasProducts = true;
            break;
        }
    }
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
 <div class="main-container">

    <div class="products-section">
      <div class="product-top-bg"></div>

      <div class="container">
        <div class="products-wrap">
          <h3 class="head-2">Products</h3>
          @if(!$hasProducts)
            <div class="product-category no-border">
              <div class="f-row f-4 f-1600-3 f-1366-2 f-990-1">
                <div class="f-col">
                  <h1>No products available.</h1>
                </div>
              </div>
            </div>
          @else
            @foreach($groupedProducts as $group)
              @if(count($group['products']) > 0)
                <div class="product-category">
                  <h3>{{ $group['productArt']->name }}</h3>
                    <div class="f-row f-4 f-1600-3 f-1366-2 f-990-1">
                        @foreach($group['products'] as $product)
                          @php
                            $getunit = getUnitByVolumeType($product->volume_type);
                          @endphp
                            <div class="f-col">
                              <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                                <div class="product-box">
                                  <h4>{{ $product->name }}</h4>
                                  @foreach ($product->targets as $target)
                                    <p class="tag">{{$target->name}}</p>
                                  @endforeach

                                  <div class="product-specs">
                                    @if($product->tension)
                                      <div class="specification">
                                        <div class="specs-icon"><img src="{{$baseUrl}}img/spec-icon.svg" alt="" class="img-icon-w-32"></div> <span>{{ $product->tension }}</span>
                                      </div>
                                    @endif
                                    @if($product->total_volume)
                                      <div class="specification">
                                        <div class="specs-icon mlr-3"><img src="{{ $getunit['image'] }}" alt="" class="img-icon-w-32"></div>
                                        <span>
                                          {{ $product->total_volume }} {{ $getunit['unit'] }}
                                        </span>
                                      </div>
                                    @endif
                                    <div class="specification">
                                      <div class="specs-icon mlr-3">
                                        <img src="{{ getArtIcon($group['productArt']->name)['image'] }}" alt="" class="img-icon-w-32">
                                      </div> <span>{{ $group['productArt']->name }}</span>
                                    </div>
                                    <div class="specification" style="width: 100%;">
                                      <div class="specs-icon mlr-3"><img src="{{$baseUrl}}img/use.svg" alt="" class="img-icon-w-32"></div> <span>
                                        {{ $product->productUse->use }}
                                        </span>
                                    </div>
                                  </div>
                                </div>
                              </a>
                            </div>
                        @endforeach
                    </div>

                  @php
                  $categoryID= $group['productArt']->id;
                  @endphp
                  <a href="{{ route('products.category', ['id' => $categoryID]) }}" class="button blue">Browse all</a>
                </div>
              @endif
            @endforeach
          @endif

        </div>
      </div>

      <div class="product-bottom-bg"></div>
    </div>


  </div>
@endsection