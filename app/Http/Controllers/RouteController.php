<?php

namespace App\Http\Controllers;

use App\Route;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role ;
use DB;
use App\RoleRoute ;
use Validator;

class RouteController extends Controller
{

    public function __construct()
    {
        $this->get_privilege();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::all() ;
        return view('route.index',compact('routes')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all() ;
        $route = null ;
        $controllers = $this->get_controllers() ; // in main controller
        $methods = array() ;
        if(isset($request['role']))
        {
            $id = $request['role'];
            $query = "SELECT * FROM routes JOIN role_route ON routes.id = role_route.route_id JOIN roles ON role_route.role_id = roles.id WHERE roles.id = $id ORDER BY routes.controller_name" ; // order by here to sort them as the file system sorting
            $methods = \DB::select($query) ;
        }
        $method_types = $this->form_methods; // Array from main controller
        return view('route.create',compact('method_types','roles','route','controllers','methods')) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'method' => 'required|min:3|unique_with:routes,method,route',
            'route' => 'required|min:3|unique_with:routes,method,route',
            'controller_name' => 'required' ,
            'function_name' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $route['method'] = $request['method'] ;
        $route['route'] = $request['route'] ;
        $route['controller_name'] = $request['controller_name'] ;
        $route['function_name'] = $request['function_name'] ;
        $added = Route::create($route) ;
        if(isset($request['role']))
        {
            foreach($request['role'] as $item)
            {
                $role_route['role_id'] = $item ;
                $role_route['route_id'] = $added->id ;
                RoleRoute::create($role_route) ;
            }
        }

        \Session::flash('success',\Lang::get('messages.custom-messages.created'));
        return redirect('all_routes') ;
    }


    public function index_v2(Request $request)
    {
        $controllers = $this->get_controllers() ; // in main controller
        $controller_name = NULL ;
        $methods = NULL ;
        $selected_routes = NULL ;
        if(isset($request['controller_name'])&&!empty($request['controller_name']))
        {
          $controller_name = $request['controller_name'] ;
          $selected_routes = Route::where('controller_name',$controller_name)->get() ;
          $methods = $this->get_controllers()[$controller_name] ;
        }
        $roles = Role::all() ;
        $method_types = $this->form_methods ;
        // dd($method_types);
        //dd($controllers);
        return view('route.index_v2',compact('controllers','selected_routes','method_types','methods','controller_name','roles')) ;
    }

    public function create_v2(Request $request)
    {

        $controllers = $this->get_controllers() ; // in main controller

        return view('route.create_v2',compact('controllers')) ;
    }

    public function get_methods_for_selected_controller(Request $request)
    {
        $controller = $request['controller'] ;
        $methods = $this->get_controllers()[$controller] ;
        return response()->json(["methods"=>$methods]) ;
    }

    public function store_v2(Request $request)
    {
        $request['route'] = array_values($request['route']);
        $route_size = count($request['route']);
        for($i = 0 ; $i < $route_size ; $i++)
        {
            if(isset($request['route'][$i][0]) && ! empty($request['route'][$i][0])
                && isset($request['route'][$i][1]) && ! empty($request['route'][$i][1])
                && isset($request['route'][$i][2]) && ! empty($request['route'][$i][2]))
            {
                $route['function_name'] = $request['route'][$i][0] ;
                $route['route'] = $request['route'][$i][1] ;
                $route['method'] = $request['route'][$i][2] ;
                $route['controller_name'] = $request['controller_name'] ;
                $check_route = Route::where('controller_name',$route['controller_name'])
                ->where('function_name',$route['function_name'])
                ->first() ;

                $checker = false ;
                if($check_route)
                {
                    $check_route->update($route) ;
                    $checker = true ;
                }
                else {
                    $check_route = Route::create($route) ;
                }
                $IDs = [] ;
                $holder = [] ;
                $role_ids = array_values($request['route'][$i]);
                for($j = 3 ; $j <= count($role_ids) ; $j++ )  // 0 function name , 1 route link , 2 method type ... so from 3 to ~ these are the roles
                {
                    if(isset($role_ids[$j]))
                    {
                        $tmp =
                            [
                            'role_id'  => (int) $role_ids[$j],
                            'route_id' => $check_route->id
                            ] ;
                        array_push($IDs,$tmp) ;
                    }
                    // $check_route->roles()->sync($IDs) ;
                }
                $this->sync_role_route($IDs,$check_route->id) ;
            }
        }
        $request->session()->flash('success',"Route Added Successfully");
        return back() ;
    }

    public function sync_role_route($array_of_ids, $route_id)
    {
        RoleRoute::where('route_id',$route_id)->delete() ;
        foreach($array_of_ids as $record)
        {
            RoleRoute::create($record) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all() ;
        $route = Route::findOrFail($id) ;
        $controllers = $this->get_controllers() ;
        $method_types = $this->form_methods; // Array from main controller
        return view('route.create',compact('method_types','roles','route','controllers')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'method' => 'required|min:3|unique_with:routes,method,route,'.$id,
            'route' => 'required|min:3|unique_with:routes,method,route,'.$id,
            'controller_name' => 'required' ,
            'function_name' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $old = Route::findOrFail($id) ;
        $old['method'] = $request['method'] ;
        $old['route'] = $request['route'] ;
        $old['controller_name'] = $request['controller_name'] ;
        $old['function_name'] =  $request['function_name'] ;
        $old->save()  ;

        RoleRoute::where('route_id',$id)->delete() ;
        if(isset($request['role']))
        {
            foreach($request['role'] as $item)
            {
                $role_route['role_id'] = $item ;
                $role_route['route_id'] = $id ;
                RoleRoute::create($role_route) ;
            }
        }
        \Session::flash('success',\Lang::get('messages.custom-messages.updated'));
        return redirect('all_routes') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Route::destroy($id) ;
        \Session::flash('success',\Lang::get('messages.custom-messages.deleted'));
        return redirect('all_routes') ;
    }

    public function store_routes_in_database()
    {
        set_time_limit(0);

        $routeCollection = \Route::getRoutes();

        foreach ($routeCollection as $value) {

            $fullAction = $value->getAction();

            if (array_key_exists('controller', $fullAction)) {

                $action = class_basename($value->getAction()['controller']);

                list($controller, $method) = explode('@', $action);

            }

            $route['method'] = $value->methods()[0];
            $route['route'] = $value->uri();
            $route['controller_name'] = $controller;
            $route['function_name'] = $method;
            $route['route_name'] = $value->getName();

            if($controller == "ContractRequestController" || $controller == "ClientPaymentController"){
              Route::create($route);
            }

          }
          return 'done!';
    }

}
