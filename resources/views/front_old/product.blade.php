@extends("front.master")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Trending <b>Products</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
                    @foreach($products as $product)
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="{{ $product->productImage }}" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>{{ $product->productName }}</h4>
									<p class="item-price"><span>{{ $product->productPrice }} {{  $product->productCurrency }}</span></p>
									<a href="#" onclick="event.preventDefault(); document.getElementById('frm-create-order').submit();" class="btn btn-primary">Buy</a>
                                    <form id="frm-create-order" action="{{ route('front.create.order') }}" method="POST" style="display: none;">
                                        <input type="hidden" value="{{ $product->productId }}" name="product_id">
                                        {{ csrf_field() }}
                                    </form>
								</div>
							</div>
						</div>
                    @endforeach
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</div>
@stop
