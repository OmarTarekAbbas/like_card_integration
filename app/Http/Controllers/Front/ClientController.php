<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
  /**
   * Method profile
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function profile()
  {
    return view("front.profile");
  }
}
