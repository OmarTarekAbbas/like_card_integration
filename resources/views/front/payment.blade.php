@extends("front.master")

@section("content")
<section class="payment_card">
  @include('front.alerts')
  @include('errors')
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

    <div class="col-6 p-0">
      <h4 class="payment_card_title text-capitalize">Amount - المبلغ</h4>
    </div>

    <div class="col-6 p-0">
      @for($i=1; $i<=1; $i++) <div class="price_background rounded">
        <button class="price_currency btn float-right" id="price{{ $i }}" data-quantity="{{ $i }}" data-currency="{{ $productCurrency }}" data-price="{{ $productPrice * $i }}"> {{ $productPrice * $i }} {{ $productCurrency }}</button>
    </div>
    @endfor
  </div>
  </div>

  <div class="quantity">
    <div class="row m-0">
      <div class="col-6 d-flex justify-content-center">
        <span class="quantity_title text-capitalize font-weight-bold">quantity - الكمية</span>
      </div>

      <div class="col-6 d-flex justify-content-center">
        <span class="total_title text-capitalize font-weight-bold">total - المجموع</span>
      </div>

      <div class="col-12">
        <div class="borderBottom"></div>
      </div>

      <div class="col-6 d-flex justify-content-center">
        <form id='myform' method='POST' class='quantity' action=''>
          @csrf
          <input type="hidden" value="{{ $productPrice }}" name="sell_price">

          <input type="hidden" value="{{ $productCurrency?? 'KWD' }}" name="currency">

          <input type="hidden" class="payment-method-value" name="payment" value="" disabled>


          <div id="sub" class="qtyminus minus sub">
            <i class=" fas fa-minus-circle"></i>
          </div>

          <input type="number" class="text-center rounded" id="quantity" name='quantity' value="1" min="1" max="9" />

          <div id="add" class="qtyplus plus add">
            <i class=" fas fa-plus-circle"></i>
          </div>
        </form>
      </div>

      <div class="col-6 d-flex justify-content-center align-items-center">
        <span class="total_price text-uppercase" id="total_price">{{$productPrice}} {{ $productCurrency }}</span>
      </div>

      {{-- <div class="col-12 d-flex justify-content-center align-items-center collPadding">
        <p class="sms_payment">بعد اتمام عملية الدفع سيصلك كود البطاقة عن طريق sms على رقم تليفونك.</p>
      </div> --}}
    </div>
  </div>

  <div class="phone_number">
    <div class="row m-0">
      <div class="col-12 d-flex justify-content-center align-items-center collPadding">
        <h5 class="payment_methods_title">اختيار طريقة الدفع</h5>
      </div>

      <div class="col-12 p-0">
        <div class="payment_methods text-center">
          <a href="#0" class="payment dcb">
            <i class="fas fa-phone"></i>
          </a>

          <a href="#0" class="payment myfatoorah">
            <i class="fab fa-cc-visa"></i>
          </a>
        </div>
      </div>

      <div class="show_details d-none">
        <div class="row m-1 myfatoorah-payment d-none">
          @for($i=2;$i<count($paymentType::getList());$i++)
            <div class="payment-method col-6 text-center">
              <a href="#0" class="btn payment-method-btn" data-method="{{ $i }}">{{ $paymentType::getLabel($i) }}</a>
            </div>
          @endfor
        </div>

        <div class="row m-0 payment-phone d-none">
          <div class="col-12 p-0">
            <h4 class="payment_card_title text-capitalize">mobile no - رقم التليفون</h4>
          </div>

          <div class="col-12 p-0">
            <div class="select_input">
              {!! Form::select("phone_code", getCountryOperators(), optional(optional(auth()->guard('client')->user())->operator)->code.'-'.optional(optional(auth()->guard('client')->user())->operator)->id , ['form' => "myform", 'required']) !!}
              <input type="tel" class="form-control" value="{{ optional(auth()->guard('client')->user())->phone }}" form="myform" name="phone" placeholder="رقم الهاتف" aria-label="Mobile_No" aria-describedby="basic-addon1">
            </div>
          </div>
        </div>

        @if(!auth()->guard("client")->check())
        <div class="row m-0">
          <div class="col-12 p-0">
            <h4 class="payment_card_title text-capitalize">email - البريد الإلكتروني</h4>
          </div>

          <div class="col-12 p-0">
            <div class="select_input" style="grid-template-columns: 100%;">
              {!! Form::email("email", optional(auth()->guard('client')->user())->email ,['class'=>'form__input form-control', 'form' => 'myform',  'placeholder'=>'Email' ]) !!}
            </div>
          </div>
        </div>
        @endif

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
          <button type="submit" class="btn_checkout btn text-capitalize" disabled form="myform">checkout</button>
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
    var cuurentPrice = ($(this).data("price")).toFixed(3); //.toFixed(1)
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
    $('#total_price').html((price * parseInt($("#quantity").val())).toFixed(3) + currency);
    $("#price" + parseInt($("#quantity").val())).trigger('focus')
  }
</script>

<script>
  function readyForm(url) {
    $("#myform").attr('action', url)
    $('.show_details').removeClass('d-none')
    $('.show_details .myfatoorah-payment').removeClass('d-none')
    $('.show_details .payment-phone').removeClass('d-none')
    $('.payment-method-value').removeAttr('disabled')
    $('.btn_checkout').removeAttr('disabled')
    $('.payment_methods .payment').css('color', "#368ca7")
  }

  $('.payment').click(function(e){
    e.preventDefault()

    if($(this).hasClass('dcb')) {
      readyForm('{{ route("front.pincode.request") }}')
      $('.show_details .myfatoorah-payment').addClass('d-none')
      $('.payment-method-value').attr('disabled', true)
      $('.myfatoorah ').css('color', '#093543')
      $('.payment-method').children(".payment-method-btn").css("background-color", '#093543')
    } else {
      readyForm('{{ route("front.myfatoorah.redirect.payment") }}')
      $('.show_details .payment-phone').addClass('d-none')
      $('.dcb').css('color', '#093543')
    }
  })

  $('.payment-method').click(function(e){
    e.preventDefault()
    var method = $(this).children('a').data('method')
    $('.payment-method-value').val(method)

    $(this).parent().children('.payment-method').children(".payment-method-btn").css("background-color", '#093543')
    $(this).children(".payment-method-btn").css("background-color", '#368ca7')
  })
</script>
@stop
