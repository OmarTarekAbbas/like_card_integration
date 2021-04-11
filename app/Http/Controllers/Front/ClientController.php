<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  /**
   * clientService
   *
   * @var \App\Services\ClientService
   */
  private $clientService;

  /**
   * Method __construct
   *
   * @param ClientService $clientService
   *
   * @return void
   */
  public function __construct(ClientService $clientService)
  {
    $this->clientService = $clientService;
  }
  /**
   * Method profile
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function getProfilePage()
  {
    return view("front.profile");
  }

  /**
   * Method updateProfile
   *
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function updateProfile(Request $request)
  {
    if($request->filled("old_password")) {
      if (!\Hash::check($request->old_password, auth()->user()->password)) {
        session()->flash("faild", "Error In Old Password");
      }
      $this->clientService->handle($request->only("password"), auth()->guard("client")->user());
      session()->flash("success", "Update User Data Successfully");
    } else {
      $this->clientService->handle($request->all(), auth()->guard("client")->user());
      session()->flash("success", "Update User Data Successfully");
    }
    return back();
  }
}
