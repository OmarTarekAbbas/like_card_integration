@extends("front.master")

@section("content")
<section class="list_content">
  <div class="row m-0">
    @forelse($products as $product)
    <div class="col-6 collPadding">
      <div class="card">
        <a class="linkable" href="#">
          <img class="card_img m-auto d-block" src="{{ $product->productImage }}" alt="{{ $product->productName }}">

          <div class="card-body text-center">
            <p class="card-text">{{ $product->productName }}</p>

            <span class="card-price text-uppercase">{{ $product->productPrice }} {{  $product->productCurrency }}</span>
          </div>
        </a>

        <a href="#" onclick="event.preventDefault(); document.getElementById('frm-create-order').submit();" class="btn_buy btn text-capitalize">buy</a>
        <form id="frm-create-order" action="{{ route('front.create.order') }}" method="POST" style="display: none;">
            <input type="hidden" value="{{ $product->productId }}" name="product_id">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
    @empty
    <div class="panel">
        <h3>Not Found</h3>
    </div>
    @endforelse
  </div>
</section>
@stop
