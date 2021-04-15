@extends("front.master")

@section("content")
  <style>
    main .list_content .card .btn_buy{
      margin-left: 3%;
    }
  </style>
<section class="list_content">
  <div class="row m-0">
    @forelse($products as $product)

    <div class="col-6 collPadding">
      <div class="card">
        <a class="linkable" href="#">
          <img class="card_img m-auto d-block" src="{{ $product->productImage }}" alt="{{ $product->productName }}">

          <div class="card-body text-center">
            <p class="card-text">{{ $product->productName }}</p>

            <span class="card-price text-uppercase">{{ $product->sellPrice }} {{  $product->productCurrency }}</span>
          </div>
        </a>

        <form id="frm-create-order" action="{{route('front.payment')}}" method="POST" >
          <button type="submit" class="btn_buy btn text-capitalize">buy</button>
          <input type="hidden" value="{{ $product->productId }}"       name="product_id">
          <input type="hidden" value="{{ $product->productImage }}"    name="productImage">
          <input type="hidden" value="{{ $product->sellPrice }}"       name="productPrice">
          <input type="hidden" value="{{ $product->productPrice }}"    name="originalPrice">
          <input type="hidden" value="{{ $product->productName }}"     name="productName">
          <input type="hidden" value="{{ $product->productCurrency }}" name="productCurrency">
          {{ csrf_field() }}
        </form>
      </div>
    </div>

    @empty
    <div class="notFound text-center">
        <h4>Not Found</h4>
    </div>
    @endforelse
  </div>
</section>
@stop
