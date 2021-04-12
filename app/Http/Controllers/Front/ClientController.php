<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserProfileRequest;
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
   * @param  \App\Http\Requests\UserProfileRequest $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateProfile(UserProfileRequest $request)
  {
    $this->clientService->handle($request->validated(), auth()->guard("client")->user());
    session()->flash("success", "Update User Data Successfully");
    return back();
  }

  /**
   * UpdatePassword
   *
   * @param  \App\Http\Requests\UpdatePasswordRequest $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function UpdatePassword(UpdatePasswordRequest $request)
  {
    $this->clientService->handle($request->validated(), auth()->guard("client")->user());
    \Session::flash('success','Password updated successfully');
    return back();
  }
}
