<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Mail;
use App\Client;
use App\OrderReplay;
use App\Constants\OrderStatus;
use App\Constants\DcbStatus;
use App\Constants\PaymentType;

class OrderController extends Controller
{
  public function index(Request $request)
  {
    return view('order.index');
  }

  public function allData(Request $request)
  {
    $orders = Order::query();
    if ($request->has('client_id') && $request->client_id != '') {
      $orders = $orders->where('client_id', $request->client_id);
    }


    //$orders = $orders->latest('created_at')->get();

    $orders = $orders->select('*','orders.id as id','clients.id as client_id','clients.name as client_name','orders.created_at as created_at_order')
    ->leftJoin('clients','clients.id','=','client_id')
    ->latest('created_at_order')
    ->get();
    //dd($orders);

    return \DataTables::of($orders)
      ->addColumn('index', function (Order $order) {
        return '<input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$order->id}}" class="roles" onclick="collect_selected(this)">';
      })
      ->addColumn('id', function (Order $order) {
          return $order->id;
      })
      ->addColumn('client_name', function (Order $order) {
        if ($order->client && isset($order->client))
          return $order->client_name??'no name';
      })
      ->addColumn('total_price', function (Order $order) {
        return $order->total_price ;
      })
      ->addColumn('created_at', function (Order $order) {
          return $order->created_at;
      })
      ->addColumn('payment_status', function (Order $order) {
        return $order->dcb_status;
      })
      ->addColumn('payment', function (Order $order) {
        return PaymentType::getLabel($order->payment);
      })
      ->addColumn('status', function (Order $order) {
        return OrderStatus::getLabel($order->status);
      })
      ->addColumn('action', function (Order $order) {
        return view('order.action', compact('order'))->render();
      })
      ->escapeColumns([])
      ->make(true);

  }

  public function show($id)
  {
    $order = Order::findOrFail($id);
    return view('order.show', compact('order'));
  }

  public function delete($id)
  {
    $order = Order::find($id);
    $order->products()->delete();
    $order->delete();
    \Session::flash('success', 'Delete Order successful');
    return back();
  }

  public function delete_product(Request $request)
  {
    $product = OrderDetail::find($request->product_id);
    $order = Order::find($request->order_id);
    $order->total_price = $order->total_price - $product->total_price;
    $order->save();
    $product->delete();
    if (count($order->products) == 0) {
      $order->delete();
      \Session::flash('success', 'Delete Order successful');
      return redirect('order');
    }
    \Session::flash('success', 'Delete Product From This Order successful');
    return back();
  }

  public function update_status(Request $request)
  {
    $client = Client::find($request->client_id);
    $order = Order::find($request->order_id);
    $last_order_status = $order->status;

    //if old status is pending and admin make it finish direct make decrease product stock and increase product solid count
    if ($request->status == OrderStatus::FINISHED && $last_order_status == OrderStatus::getLabel(OrderStatus::PENDING)  &&
       ($order->payment == PaymentType::getLabel(PaymentType::CASH) || $order->payment == PaymentType::getLabel(PaymentType::VISA_AFTER_DELIVER))) {

      $order->payment_status = DcbStatus::Success;
      // $this->handleStockAndSolidCountForProductAfterChangeOrderStatus($request);
    }

    //if old status is pending and admin make it UNDER SHIPPING direct make decrease product stock and increase product solid count
    if ($request->status == OrderStatus::UNDER_SHIPPING && $last_order_status == OrderStatus::getLabel(OrderStatus::PENDING)  &&
       ($order->payment == PaymentType::getLabel(PaymentType::CASH) || $order->payment == PaymentType::getLabel(PaymentType::VISA_AFTER_DELIVER))) {

      // $this->handleStockAndSolidCountForProductAfterChangeOrderStatus($request);
    }

    //if old status is UNDER SHIPPING and admin make it FINISHED direct make payment status success
    if ($request->status == OrderStatus::FINISHED  && $last_order_status == OrderStatus::getLabel(OrderStatus::UNDER_SHIPPING) &&
       ($order->payment == PaymentType::getLabel(PaymentType::CASH) || $order->payment == PaymentType::getLabel(PaymentType::VISA_AFTER_DELIVER))) {

      $order->payment_status = DcbStatus::Success;
    }

    if($request->status == OrderStatus::NOT_AVAILABLE &&
      ($order->payment == PaymentType::getLabel(PaymentType::CASH) || $order->payment == PaymentType::getLabel(PaymentType::VISA_AFTER_DELIVER))) {
        $mail_template_page = "front.mail_not_available";
        dispatch(new SendOrderMailJob($order, $client, $request->message, $mail_template_page));
    } else {
        $mail_template_page = "front.mail";
        dispatch(new SendOrderMailJob($order, $client, $request->message, $mail_template_page));
    }

    $order->status = $request->status;
    $order->save();
    $this->savedOrderReply($order, $request);
    \Session::flash('success', 'Email Is Send With Order Status');
    return back();
  }

  public function load_notify($number)
  {
    $notify_ids = \App\Notification::with('send_user')->where('notified_id', \Auth::id())->latest()->take($number)->pluck('id');
    //return $notify_ids;
    $notifys = \App\Notification::with('send_user')->where('notified_id', \Auth::id())->whereNotIn('id', $notify_ids)->latest()->take(2)->get();
    return $notifys;
  }

  /**
   * Method savedOrderReply
   *
   * @param Order $order
   * @param Request $request
   *
   * @return void
   */
  public function savedOrderReply($order, $request)
  {
    $data['status']    = $request->status;
    $data['order_id']  = $order->id;
    $data['client_id'] = $request->client_id;
    $data['admin_id']  = auth()->id();
    $data['message']   = $request->message;

    OrderReplay::create($data);
  }

  /**
   * Method removeProductFromOrderDeatilsThatNotHaveOrder
   *
   * @return void
   */
  public function removeProductFromOrderDeatilsThatNotHaveOrder()
  {
      \App\OrderDetail::doesntHave("order")->delete();
      echo "Done" ;
  }

  /**
   * Method handleStockAndSolidCountForProductAfterChangeOrderStatus
   *
   * when order status change to finish or under shipping make decrease for product stock and increase for product solid count
   *
   * @param Request $request
   *
   * @return void
   */
  public function handleStockAndSolidCountForProductAfterChangeOrderStatus($request)
  {
    $carts = OrderDetail::where('order_id', $request->order_id)->get();
    foreach ($carts as $key => $cart) {
      $product = Product::find($cart->product_id);
      $product->stock       = $product->stock - $cart->quantity;
      $product->solid_count = $product->solid_count + $cart->quantity;
      $product->save();
    }
  }
}
