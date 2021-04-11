<?php
namespace App\Http\Controllers\Front\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class ClientLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLoginForm()
    {
        return view('front.auth.login');
    }


    protected function guard()
    {
        return Auth::guard('client');
    }

    protected function authenticated(Request $request, $user)
    {
        if(isset($_COOKIE['carts'])){
            $carts = unserialize($_COOKIE['carts']);
            for ($i=0; $i < count($carts) ; $i++) {
                Cart::create([
                    'product_id' => $carts[$i]['product_id'],
                    'client_id' => $user->id,
                    'quantity'=> $carts[$i]['quantity'],
                    'price'  => $carts[$i]['price'],
                    'total_price' => $carts[$i]['price'] * $carts[$i]['quantity']
                ]);
            }
            unset($_COOKIE['carts']);
            setcookie('carts','', time() - 3600, "/", config('app.APP_DOMAIN'));
        }
        return redirect()->intended($this->redirectPath());
    }

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return url('home');
    }

    /**
     * Method logout
     *
     * @return Redirect
     */
    public function logout()
    {
        auth()->guard('client')->logout();
        return redirect('home');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }
}
