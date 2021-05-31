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
      ->addColumn('client_email', function (Order $order) {
        if ($order->client && isset($order->client))
          return $order->client->email??'no email';
      })
      ->addColumn('total_price', function (Order $order) {
        return $order->total_price ;
      })
      ->addColumn('created_at', function (Order $order) {
          return $order->created_at;
      })
      ->addColumn('payment_status', function (Order $order) {
        return $order->payment == PaymentType::DCB ?  $order->dcb_status : '----';
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
    $order = Order::with("replaies")->whereId($id)->first();
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

  public function sendMessage(Request $request)
  {
    $client = Client::find($request->client_id);
    Mail::send('front.mails.order_mail', ['data' => $request->message], function ($m) use ($client) {
      $m->from(auth()->user()->email, 'super admin');
      $m->to($client->email, $client->name ??'default name')->subject('Order Mail');
    });
    $this->savedOrderReply($request);
    session()->flash('success', 'Email Is Send With Order Status');
    return back();
  }

  /**
   * Method savedOrderReply
   *
   * @param Request $request
   * @return void
   */
  public function savedOrderReply($request)
  {
    $data['order_id']  = $request->order_id;
    $data['client_id'] = $request->client_id;
    $data['admin_id']  = auth()->id();
    $data['message']   = $request->message;

    OrderReplay::create($data);
  }
}
