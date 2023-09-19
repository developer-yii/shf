<!-- pagination/products.blade.php -->

@foreach ($currentPageProducts as $product)
    <div class="f-col">
        <div class="product-box">
            <a href="{{ route('product.detail', ['id' => $product->id]) }}">
                <h4>{{ $product->name }}</h4>
            </a>
            @foreach ($product->targets as $target)
                <p class="tag">{{ $target->name }}</p>
            @endforeach

            <div class="product-specs">
                <div class="specification">
                    <div class="specs-icon"><img src="{{ $product->unit['image'] }}" alt=""></div>
                    <span>{{ $product->total_volume }} {{ $product->unit['unit'] }}</span>
                </div>
                <div class="specification">
                    <div class="specs-icon"><img src="{{ $product->artIcon }}" alt=""></div>
                    <span>{{ $group['productArt']->name }}</span>
                </div>
                <div class="specification">
                    <div class="specs-icon"><img src="{{$baseUrl}}img/use.svg" alt=""></div>
                    <span>{{ $product->productUse->use }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{ $currentPageProducts->links() }}
