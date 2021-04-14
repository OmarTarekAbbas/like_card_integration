@extends("front.master")

@section("content")
<section class="payment_card">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="col-4 collPadding collFloat">
        <div class="card_background rounded">
          <a href="#0">
            <img class="card_img m-auto d-block" src="{{$productImage}}" alt="{{$productName}}">
          </a>
        </div>
      </div>
    </div>

    <div class="col-12 p-0">
      <h4 class="payment_card_title text-capitalize">Amount - المبلغ</h4>
    </div>
  </div>
  <div class="grid_view">
    @for($i=1; $i<=9; $i++) <div class="price_background rounded">
      <button class="price_currency btn" id="price{{ $i }}" data-quantity="{{ $i }}" data-currency="{{ $productCurrency }}" data-price="{{ $productPrice * $i }}"> {{ $productPrice * $i }} {{ $productCurrency }}</button>
  </div>
  @endfor
  </div>

  <div class="phone_number">
    <div class="row m-0">
      <div class="col-12 p-0">
        <h4 class="payment_card_title text-capitalize">mobile no - رقم التليفون</h4>
      </div>

      <div class="col-12 p-0">
        <div class="select_input">
          <select>
            <option>Action</option>
            <option>Another action</option>
            <option>Something else here</option>
          </select>
          <input type="tel" class="form-control" placeholder="Mobile No." aria-label="Mobile_No" aria-describedby="basic-addon1">
        </div>
      </div>

      <div class="col-12 p-0">
        <h4 class="payment_card_title text-capitalize">confirm mobile no - تأكيد رقم التليفون</h4>
      </div>

      <div class="col-12 p-0">
        <div class="select_input">
          <select>
            <option>Action</option>
            <option>Another action</option>
            <option>Something else here</option>
          </select>
          <input type="tel" class="form-control" placeholder="Confirm Mobile No." aria-label="Mobile_No" aria-describedby="basic-addon2">
        </div>
      </div>
    </div>
  </div>

  <div class="quantity">
    <div class="row m-0">
      <div class="col-6 d-flex justify-content-center">
        <span class="quantity_title text-capitalize font-weight-bold">quantity</span>
      </div>

      <div class="col-6 d-flex justify-content-center">
        <span class="total_title text-capitalize font-weight-bold">total</span>
      </div>

      <div class="col-12">
        <div class="borderBottom"></div>
      </div>

      <div class="col-6 d-flex justify-content-center">
        <form id='myform' method='POST' class='quantity' action='{{ route("front.pincode.request") }}'>
          @csrf
          <input type="hidden" value="{{ $productPrice?? 10 }}" name="price">

          <input type="hidden" value="{{ $productCurrency?? 'KWT' }}" name="currency">

          <div id="sub" class="qtyminus minus sub">
            <i class=" fas fa-minus-circle"></i>
          </div>

          <input type="number" class="text-center rounded" id="quantity" name='quantity' value="1" min="1" max="9"/>

          <div id="add" class="qtyplus plus add">
            <i class=" fas fa-plus-circle"></i>
          </div>
        </form>
      </div>

      <div class="col-6 d-flex justify-content-center align-items-center">
        <span class="total_price text-uppercase" id="total_price">{{$productPrice}} {{ $productCurrency }}</span>
      </div>

      <div class="col-12 d-flex justify-content-center align-items-center collPadding">
        <p class="sms_payment">بعد اتمام عملية الدفع سيصلك كود البطاقة عن طريق sms على رقم تليفونك.</p>
      </div>

      <div class="col-12 d-flex justify-content-center align-items-center collPadding">
        <div class="form-group yes_understand">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck1">
            <label class="form-check-label text-capitalize" for="gridCheck1">yes, i understand | نعم، انا أعلم</label>
          </div>
        </div>
      </div>

      <div class="col-12 d-flex justify-content-center align-items-center collPadding">
        <div class="my_checkout">
          <button type="submit" class="btn_checkout btn text-capitalize" form="myform">checkout</button>
        </div>
      </div>
    </div>
  </div>

</section>
@stop

@section("script")
<script>
  var price = '{{$productPrice}}'
  var currency = ' {{$productCurrency}}'

  $('.price_currency').click(function() {
    var cuurentPrice = ($(this).data("price")).toFixed(1);
    $('#total_price').text(cuurentPrice + currency);
    $("#quantity").val($(this).data("quantity"));
  });

  $('.add').click(function() {
    if (parseInt($("#quantity").val()) >= 9) {
      return;
    }
    $("#quantity").val(parseInt($("#quantity").val()) + 1);
    setTotalPrice()
  });

  $('.sub').click(function() {
    if (parseInt($("#quantity").val()) <= 1) {
      return;
    }
    $("#quantity").val(parseInt($("#quantity").val()) - 1);
    setTotalPrice()
  });

  function setTotalPrice() {
    $('#total_price').html((price * parseInt($("#quantity").val())).toFixed(1) + currency);
    $("#price" + parseInt($("#quantity").val())).trigger('focus')
  }
</script>
@stop
