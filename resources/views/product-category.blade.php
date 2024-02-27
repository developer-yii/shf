@php
$baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
<div class="main-container">

  <div class="products-section">
    <div class="product-top-bg"></div>

    <div class="container">
      <div class="products-wrap">

        <h3 class="head-2">{{ $productArt->name }}</h3>
        <div class="product-category no-border">
          <div class="f-row f-4 f-1600-3 f-1366-2 f-990-1">
            @if($groupedProducts->isEmpty())
            <div class="f-col">
              <h1>No products available.</h1>
            </div>
            @else
              @foreach($groupedProducts as $product)
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
                          <div class="specs-icon"><img src="{{$baseUrl}}img/spec-icon.svg" alt=""></div> <span>{{ $product->tension }}</span>
                        </div>
                      @endif
                      @if($product->total_volume)
                        <div class="specification">
                          <div class="specs-icon mlr-3"><img src="{{ $getunit['image'] }}" alt=""></div>
                          <span>
                            {{ $product->total_volume }} {{ $getunit['unit'] }}
                          </span>
                        </div>
                      @endif
                      <div class="specification">
                        <div class="specs-icon mlr-3"><img src="{{ getArtIcon($productArt->name)['image'] }}" alt=""></div> <span>{{ $productArt->name }}</span>
                      </div>
                      <div class="specification" style="width: 100%;">
                        <div class="specs-icon"><img src="{{$baseUrl}}img/use.svg" alt=""></div> <span>
                          {{ $product->productUse->use }}
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach
            @endif

          </div>
        </div>

        <div class="pagination">
          {!! $groupedProducts->links('pagination::bootstrap-4') !!}
        </div>

      </div>
    </div>

    <div class="product-bottom-bg"></div>
  </div>
</div>

@endsection