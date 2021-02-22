<?php

namespace App\Http\Controllers;

use App\RoleRoute;
use App\Route as RouteModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * userRole
     *
     * @var string
     */
    private $userRole;
    /**
     * route
     *
     * @var string
     */
    private $route;

    public $form_methods = [
                            "get"=>"GET",
                            "post"=>"POST",
                            "patch"=>"PATCH",
                            "delete"=>"DELETE",
                            "put"=>"PUT"
                            ] ;

    public function get_methods($filename)
    {
        $path = $this->file_build_path("app","Http","Controllers") ;
        $txt_file    = file_get_contents($path.'/'.$filename);
        $matches = array() ;
        preg_match_all("/ function (.*)\(\D*\w*\)/U", $txt_file, $matches);
        $result = $matches[1] ;
        return $result ;
    }

    public function get_controllers() {
        $controllers = array() ;
        $i = 0 ;
        $path = $this->file_build_path("app","Http","Controllers") ;
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file!="Auth" && $file!="Controller.php" && $file!="ScaffoldInterface") {
                    $parsed_methods[explode('.php',$file)[0]] =
                        $this->get_methods($file) ;
                }
            }
            closedir($handle);
            return $parsed_methods ;
        }
    }

    public function file_build_path(...$segments) {
        return join(DIRECTORY_SEPARATOR, $segments);
    }

    public function delete_image_if_exists($image_path)
    {
        if(file_exists($image_path))
        {
            unlink($image_path) ;
        }
    }

    public function get_privilege()
    {
      $this->middleware(function ($request, $next) {

        if(Auth::user()){

          $this->userRole = Auth::user()->roles->first()->id;
          if($this->userRole == 1){
              return $next($request);
          }

          $uri = Route::current()->uri;
          $method = strtolower(Route::current()->methods[0]);

          $this->route = RouteModel::where('route', $uri)->where('method', $method)->first()->id;

          $routeRole = RoleRoute::where('role_id', $this->userRole)->where('route_id', $this->route)->first();

          if($routeRole){
            return $next($request);
          }else{
            return redirect('/')->with('failed', 'You Dont Have The Privilege To Access This page!');
          }

        }
        else{
          return redirect('login');
        }

      });

    }
}
