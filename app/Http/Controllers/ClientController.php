<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
class ClientController extends Controller
{
  public function index(Request $request)
  {
    return view('client.index');
  }

  public function allData(Request $request)
  {
    $clients = Client::with("operator")->get();

    return \DataTables::of($clients)
      ->addColumn('index', function (Client $client) {
        return '<input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$client->id}}" class="roles" onclick="collect_selected(this)">';
      })
      ->addColumn('image', function (Client $client) {
          return '<td> <img src="'.$client->image.'" alt="" width="100px" height="100px" style="border-radius:10px"> </td>';
      })
      ->addColumn('name', function (Client $client) {
          return $client->name??'no name';
      })
      ->addColumn('phone', function (Client $client) {
        return $client->phone?? 'no pnone' ;
      })
      ->addColumn('email', function (Client $client) {
          return $client->email;
      })
      ->addColumn('operator', function (Client $client) {
        return optional($client->operator)->name;
      })
      ->addColumn('action', function (Client $client) {
        return view('client.action', compact('client'))->render();
      })
      ->escapeColumns([])
      ->make(true);

  }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        \Session::flash('success','Delete Client Successfuly');
        return back();
    }

}
