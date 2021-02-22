<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use DB;
use Spatie\Permission\Models\Role;
use Validator;
use Auth;
class UserController extends Controller
{

    public function __construct()
    {
      $this->get_privilege();
    }

    public function index()
    {
        $userdata = \Auth::user() ;
        $userRole = $userdata->roles()->first() ;
        $userPiriority = 999 ;
        if($userRole)
            $userPiriority = $userRole->role_priority ;
        $users = User::join('user_has_roles','user_has_roles.user_id','=','users.id')
        ->join('roles','user_has_roles.role_id','=','roles.id')
        ->where('roles.role_priority','<=',$userPiriority)
        ->select('roles.name AS role','users.*')
        ->get() ;

        return view('users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $user = new \App\User();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        if(isset($request->phone)&&!empty($request->phone))
            $user->phone = $request->phone ;


        $user->save();

        $user->assignRole($request->role);

        $request->session()->flash('success','User Added Successfully');
        return redirect('users');
    }


    public function edit($id)
    {

        $user = \App\User::findOrfail($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }


    public function update($id,Request $request)
    {

        # code...
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = \App\User::findOrfail($id);

        $user->email = $request->email;
        $user->name = $request->name;
        if(isset($request->password) && !empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }

        if(isset($request->phone)&&!empty($request->phone))
            $user->phone = $request->phone ;

        \Session::flash('success','User updated successfully');
        $user->save();

        $user->syncRoles([$request->role]);

        // dd($user->hasAnyRole(['admin']));

        return redirect('users');
    }


    public function destroy($id)
    {
        if (Auth::user()->hasRole('super_admin')) {
            # code...
            $user = \App\User::findOrfail($id);
            if (file_exists($user->profile_image))
                Storage::delete($user->profile_image);
            $user->delete();
            \Session::flash('success','User has been deleted successfully');
            return redirect('users');
        }else{
            return back();
        }
    }


    public function addRole(Request $request)
    {

            # code...
        $user = \App\User::findOrfail($request->user_id);
        $user->assignRole($request->role_name);
            \Session::flash('success','Role Added successfully');
        return redirect('users/edit/'.$request->user_id);
    }


    public function revokeRole($role, $user_id)
    {

        # code...
        $user = \App\User::findorfail($user_id);

        $user->removeRole(str_slug($role, ' '));

        return redirect('users/edit/'.$user_id);
    }

    public function profile()
    {
        $user = \Auth::user();
        if (! file_exists($user->profile_image))
        {
            $user->profile_image = 'profile_images/avatar.png' ;
        }
        return view('userprofile.profile',compact('user'));
    }


    public function admin_credential_rules(array $data)
    {

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ]);

        return $validator;
    }

    public function UpdatePassword(Request $request)
    {
        $request_data = $request->All();
        $validator = $this->admin_credential_rules($request_data);
        if($validator->fails())
        {
            \Session::flash('failed',"password confirmation must be the same of the new password, and all fields are required") ;
            return redirect('user_profile');
        }
        else
        {
            $current_password = Auth::User()->password;
            if(Hash::check($request_data['current-password'], $current_password))
            {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();
                \Session::flash('success','Password updated successfully');
                return redirect('user_profile');
            }
            else
            {
                \Session::flash('failed','Wrong current password entered!');
                return redirect('user_profile');
            }
        }
    }

    public function UpdateProfilePicture(Request $request)
    {
        if (! $request->hasFile('image'))
        {
            \Session::flash('failed','Submitting Image Form without image !!!! please choose image before submitting that form!');
            return redirect('user_profile');
        }
        $imgExtensions = array("png","jpeg","jpg");
        $user_id = Auth::User()->id;
        $destinationFolder = "profile_images/" ;
        $file = $request->file('image');
        if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
        {
            \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
            return redirect('user_profile');
        }
        $obj_user = User::find($user_id);
        if (file_exists($obj_user->image))
            Storage::delete($obj_user->image);
        $uniqueID = uniqid();
        $file->move($destinationFolder,$uniqueID.".".$file->getClientOriginalExtension());
        $obj_user->image = $destinationFolder.$uniqueID.".".$file->getClientOriginalExtension() ;
        \Session::flash('success','Profile picture updated');
        $obj_user->save();
        return redirect('user_profile');
    }



    public function UpdateNameAndEmail(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::User()->id,
        ]);
        if ($validator->fails()) {
            $request->session()->flash('failed','Email and phone must be unique');
            return back()->withErrors($validator)->withInput();
        }
        $id = Auth::User()->id ;
        $user_obj = User::findOrFail($id);
        $user_obj->name = $request['name'];
        $user_obj->email = $request['email'];
        $user_obj->phone = $request['phone'] ;
        $user_obj->save();
        $request->session()->flash('success','Updated Successfully');
        return redirect('user_profile');
    }


}
