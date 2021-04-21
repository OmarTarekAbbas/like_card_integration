<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with("operator")->get();
        return view('client.index',compact('clients'));
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        \Session::flash('success','Delete Client Successfuly');
        return back();
    }

}
