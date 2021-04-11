@extends('front.master')

@section('content')

<div class="shopping_cart">
  <div class="product">
    <div class="header">
      <a class="remove">
        <span>&#215;</span>
        <img class="cart_img m-auto d-block" src="{{ asset('front/images/logos/10.png') }}" alt="Product">

      </a>
    </div>

    <div class="content">

      <h1 class="content_title" 1>Air Jordan 10 “Teal Graffiti” Custom</h1>
      <p class="content_desc">Transforming a classic colorway into an Air Jordan 10 “Teal Graffiti” Custom that sports an Air Tech Challenge-inspired print throughout the upper, complementing the Graffiti print.</p>
    </div>

    <div class="footer m-auto">
      <span class="qt-minus">-</span>
      <span class="qt">2</span>
      <span class="qt-plus">+</span>

      <h2 class="full-price">69.98</h2>

      <h2 class="price">34.99</h2>
    </div>
  </div>

  <div class="product">
    <div class="header">
      <a class="remove">
        <span>&#215;</span>
        <img class="cart_img m-auto d-block" src="{{ asset('front/images/logos/10.png') }}" alt="Product">

      </a>
    </div>

    <div class="content">

      <h1 class="content_title" 1>Air Jordan 10 “Teal Graffiti” Custom</h1>
      <p class="content_desc">Transforming a classic colorway into an Air Jordan 10 “Teal Graffiti” Custom that sports an Air Tech Challenge-inspired print throughout the upper, complementing the Graffiti print.</p>
    </div>

    <div class="footer m-auto">
      <span class="qt-minus">-</span>
      <span class="qt">2</span>
      <span class="qt-plus">+</span>

      <h2 class="full-price">69.98</h2>

      <h2 class="price">34.99</h2>
    </div>
  </div>

  <div id="site-footer">
    <div class="left">
      <h2 class="subtotal">Subtotal:
        <span class="price_right">163.96 <i class="fas fa-dollar-sign"></i></span>
      </h2>

      <h3 class="tax">Taxes (5%):
        <span class="price_right">8.2 <i class="fas fa-dollar-sign"></i></span>
      </h3>

      <h3 class="shipping">Shipping:
        <span class="price_right">5.00 <i class="fas fa-dollar-sign"></i></span>
      </h3>
    </div>

    <div class="right">
      <h1 class="total">Total: <span>177.16</span><i class="fas fa-dollar-sign"></i></h1>
      <a class="btn">Checkout</a>
    </div>

  </div>
</div>

@stop
