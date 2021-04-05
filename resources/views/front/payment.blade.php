@extends("front.master")

@section("content")
<section class="payment_card">
  <div class="row m-0">
    <div class="col-12 p-0">
      <div class="col-4 collPadding collFloat">
        <div class="card_background rounded">
          <a href="payment.php">
            <img class="card_img m-auto d-block" src="{{ asset('images/logos/17.png') }}" alt="itunes">
          </a>
        </div>
      </div>
    </div>

    <div class="col-12 p-0">
      <h4 class="payment_card_title text-capitalize">Amount - المبلغ</h4>
    </div>
  </div>

  <div class="grid_view">
    <div class="price_background rounded">
      <button class="price_currency btn">5 <span class="currency">$</span></button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn">10 <span class="currency">$</span></button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn">15 <span class="currency">$</span></button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn">20 <span class="currency">$</span></button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn">25 <span class="currency">$</span></button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn">30 <span class="currency">$</span></button>
    </div>

    <!-- <div class="price_background rounded">
      <button class="price_currency btn text-capitalize"><span class="currency">+1</span> month</button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn text-capitalize"><span class="currency">+2</span> months</button>
    </div>

    <div class="price_background rounded">
      <button class="price_currency btn text-capitalize"><span class="currency">+3</span> months</button>
    </div> -->
  </div>

  <div class="phone_number">
    <div class="row m-0">
      <div class="col-12 p-0">
        <h4 class="payment_card_title text-capitalize">mobile no - رقم التليفون</h4>
      </div>

      <div class="col-12 p-0">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">+965</span>
          </div>
          <input type="tel" class="form-control" placeholder="Mobile No." aria-label="Mobile_No" aria-describedby="basic-addon1">
        </div>
      </div>

      <div class="col-12 p-0">
        <h4 class="payment_card_title text-capitalize">confirm mobile no - تأكيد رقم التليفون</h4>
      </div>

      <div class="col-12 p-0">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2">+965</span>
          </div>
          <input type="tel" class="form-control" placeholder="Mobile No." aria-label="Mobile_No" aria-describedby="basic-addon2">
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
        <form id='myform' method='POST' class='quantity' action='#'>
          <div id="sub" class="qtyminus minus sub">
            <i class=" fas fa-minus-circle"></i>
          </div>
          <input type="number" id="1" name='quantity' value="1" min="1" max="6" />
          <div id="add" class="qtyplus plus add">
            <i class=" fas fa-plus-circle"></i>
          </div>
        </form>
      </div>

      <div class="col-6 d-flex justify-content-center align-items-center">
        <span class="total_price text-uppercase">0.000 kd</span>
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
        <form action="#0" class="my_checkout">
          <button type="submit" class="btn_checkout btn text-capitalize">checkout</button>
        </form>
      </div>
    </div>
  </div>



</section>
@stop
