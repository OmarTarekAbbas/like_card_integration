<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RouteModel ;

class RoleController extends Controller
{

    public function __construct()
    {
      $this->get_privilege();
    }

    public function index()
    {

        # code...
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }


    public function create()
    {

            # code...
           return view('roles.create');
    }


    public function store(Request $request)
    {
        $check = Role::where('name',$request['name'])->get();
        if (count($check)>0)
        {
            \Session::flash('failed','This role already exists');
            return redirect('roles');
        }

            $validator = Validator::make($request->all(),[
                    'name' => 'required',
                    'role_priority' => 'required'
                ]);
            if ($validator->fails()) {
                return back()->withError($validator)->withInput();
            }
            \Session::flash('success','Role added successfully');
            Role::create(['name' => $request->name , 'role_priority' => $request->role_priority]);

            return redirect('roles');

    }

    public function edit($id)
    {

            $role = Role::findOrFail($id);

            return view('roles.edit', compact('role'));

    }


    public function update(Request $request)
    {
        $check = Role::where('name',$request->name)->where('id','!=',$request->role_id)->get();
        if (count($check)>0)
        {
            \Session::flash('failed','Role already exists');
            return back();
        }

            $validator = Validator::make($request->all(),[
                    'name' => 'required',
                    'role_priority' => 'required'
                ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $role = Role::findOrFail($request->role_id);

            $role->name = $request->name;
            $role->role_priority = $request->role_priority;
            \Session::flash('success','Role Updated successfully');
            $role->update();

            return redirect('roles');

    }


    public function destroy($id)
    {

            $role = Role::findOrFail($id);

            $role->delete();

            return redirect('roles');
    }

    public function view_access($id)
    {
        $controllers = $this->get_controllers() ; // in main controller
        $routes = RouteModel::all() ;
        $role = Role::findOrFail($id) ;
        $query = "SELECT * FROM routes JOIN role_route ON routes.id = role_route.route_id JOIN roles ON role_route.role_id = roles.id WHERE roles.id = $id ORDER BY routes.controller_name" ; // order by here to sort them as the file system sorting
        $methods = \DB::select($query) ;
        return view('roles.access',compact('role','routes','controllers','methods')) ;
    }


}
















