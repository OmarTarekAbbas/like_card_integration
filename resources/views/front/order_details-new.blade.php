@extends("front.master")

@section("content")
<section class="order_details">
  <div class="card card-1">
    <div class="card-header bg-white">
      <div class="media row justify-content-between mb-3">
        <div class="col-6 my-auto p-0">
          <h6 class="mb-0">Thanks for your Order !</h6>
        </div>

        <div class="col-6 text-center my-auto pl-0 pt-sm-4">
          <img class="img-fluid my-auto align-items-center mb-0 pt-3 w-50" src="https://i.imgur.com/7q7gIzR.png">
          <p class="mb-4 pt-0 Glasses">Digicards</p>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="row justify-content-between mb-3">
        <div class="col-6 p-0">
          <h6 class="color-1 mb-0 change-color">Receipt</h6>
        </div>

        <div class="col-6 p-0">
          <small class="font-weight-bold">Receipt Voucher : 34427724</small>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-12 p-1">
          <div class="card card-2">
            <div class="card-body">
              <div class="card_grid">
                <div class="sq align-self-center">
                  <img class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="https://likecard-space.fra1.digitaloceanspaces.com/products/9cf24-likecardlogo.png">
                </div>

                <div class="media-body my-auto">
                  <div class="row my-auto flex-column flex-md-row">
                    <div class="col-12 my-auto">
                      <h6 class="mb-0"> <span class="font-weight-bold"> ProductName : </span> test-itunes1</h6>
                    </div>
                    <div class="col-12 my-auto"> <span class="font-weight-bold"> serial Id : </span> <small> 25413216</small></div>
                    <div class="col-12 my-auto">
                      <h6 class="mb-0"> <span class="font-weight-bold"> validTo: </span> 24/06/2021</h6>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-3 ">
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-12 p-1">
          <div class="row justify-content-between m-0">
            <div class="col-12 text-center">
              <p class="mb-1 text-dark"><b>Order Details</b></p>
            </div>

            <div class="col-12 text-center">
              <p class="mb-1"><b>Total: </b><span>0.01 KWD</span></p>
            </div>
          </div>

          <div class="row justify-content-between m-0">
            <div class="col-12 text-center">
              <p class="mb-1"><b>Payment: </b><span>Pocket</span></p>
            </div>
          </div>

          <div class="row justify-content-between m-0">
            <div class="col-12 text-center">
              <p class="mb-1"><b>Status:</b> <span>completed</span></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row invoice">
        <div class="col">
          <p class="mb-1"> Invoice Number : 34427724</p>
          <p class="mb-1">Invoice Date : 2021-03-24 07:09</p>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
