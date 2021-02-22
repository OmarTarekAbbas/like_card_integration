<?php

namespace App\Http\Controllers;

use Hamcrest\Core\Set;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Type;
use Amranidev\Ajaxis\Ajaxis;
use Illuminate\Support\Facades\Storage;
use URL;

use Validator;
/**
 * Class SettingController.
 *
 * @author  The scaffold-interface created at 2017-04-02 02:44:30pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class SettingController extends Controller
{
    public function __construct()
    {
      $this->get_privilege();
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - setting';
        $settings = Setting::with('type')->orderBy('order','ASC')->get();
        return view('setting.index',compact('settings','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - setting';
        $types = Type::pluck('title','id');
        return view('setting.create',compact('title','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'key' => 'required|unique:settings',
            'myField' =>'required'
        ]);
        $setting = new Setting();
        $check = false ;

        if($request['myField'] == '3')
        {
           if ($request->hasFile('Image'))
            {
                $imgExtensions = array("png","jpeg","jpg");
                $destinationFolder = "uploads/settings_images/";
                $file = $request->file("Image");
                if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
                {
                    \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
                    return back();
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
           }
        }
        else if($request['myField'] == '4')
        {
           if ($request->hasFile('Video'))
            {
                $vidExtensions = array("mp4","flv","3gp");
                $destinationFolder = "uploads/settings_videos/";
                $file = $request->file("Video");
                if(! in_array($file->getClientOriginalExtension(),$vidExtensions))
                {
                    \Session::flash('failed','Video must be mp4, flv, or 3gp only !! No updates takes place, try again with that extensions please..');
                    return back();
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
           }
        }

        else if($request['myField'] == '5')
        {
           if ($request->hasFile('Audio'))
            {
                $audExtensions = array("mp3","webm","wav");
                $destinationFolder = "uploads/settings_sounds/";
                $file = $request->file("Audio");
                if(! in_array($file->getClientOriginalExtension(),$audExtensions))
                {
                    \Session::flash('failed','Audio must be mp3, webm and wav only !! No updates takes place, try again with that extensions please..');
                    return back() ;
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
           }
        }
        else if($request['myField']==6)
        {
            if(count($request['extensions']) > 0 )
            {
                $setting->value = implode(",",$request['extensions']) ;

                foreach($request['extensions'] as $extension)
                {
                    if($extension=="all")
                    {
                        $setting->value = "all" ;
                        break ;
                    }
                }

                $check = true  ;
            }
        }
        else if($request['myField']=='7')
        {
          $setting->value = $request->selector;
          $check = true ;
        }

        $setting->key = $request->key;
        if(!$check)
        {
            if (!empty($request->Advanced_Text)){
                $setting->value = $request->Advanced_Text;}
            elseif (!empty($request->Normal_Text)){
                $setting->value = $request->Normal_Text;}
            else
            {
                \Session::flash('failed','Value is Required');
                return back()->withInput();
            }
        }
        $setting->type_id = $request->myField;
        $setting->save();
        $request->session()->flash('success', 'Setting created successfull');

        return redirect('setting');
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit - setting';
        $setting = Setting::with(['type'])->findOrfail($id);
        return view('setting.edit',compact('title','setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $this->validate($request,[
            'key' => 'required'
        ]);
        $setting = Setting::findOrfail($id);
        $check = false ;

        if($setting->type_id == "3")
        {
            if ($request->hasFile('value'))
            {

                $imgExtensions = array("png","jpeg","jpg");
                $destinationFolder = "uploads/settings_images/";
                $file = $request->file("value");
                if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
                {
                    \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
                    return back();
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                if (file_exists($setting->value))
                {
                    unlink($setting->value);
                }
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
            }
        }
        else if($setting->type_id == "4")
        {
            if ($request->hasFile('Video'))
            {

                $vidExtensions = array("mp4","flv","3gp");
                $destinationFolder = "uploads/settings_videos/";
                $file = $request->file("Video");
                if(! in_array($file->getClientOriginalExtension(),$vidExtensions))
                {
                    \Session::flash('failed','Video must be mp4, flv, or 3gp only !! No updates takes place, try again with that extensions please..');
                    return back();
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                if (file_exists($setting->value))
                {
                    unlink($setting->value);
                }
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
            }
        }
        else if($setting->type_id == "5")
        {
            if ($request->hasFile('Audio'))
            {

                $audExtensions = array("mp3","webm","wav");
                $destinationFolder = "uploads/settings_sounds/";
                $file = $request->file("Audio");
                if(! in_array($file->getClientOriginalExtension(),$audExtensions))
                {
                    \Session::flash('failed','Audio must be mp3, webm, and wav !! No updates takes place, try again with that extensions please..');
                    return back();
                }
                $uniqueid = uniqid();
                $file->move($destinationFolder,$uniqueid.".".$file->getClientOriginalExtension());
                if (file_exists($setting->value))
                {
                    unlink($setting->value);
                }
                $setting->value = $destinationFolder.$uniqueid.".".$file->getClientOriginalExtension();
                $check = true ;
            }
        }
        else if($setting->type_id == 6)
        {
            if(count($request['extensions']) > 0 )
            {
                $setting->value = implode(",",$request['extensions']) ;

                foreach($request['extensions'] as $extension)
                {
                    if($extension=="all")
                    {
                        $setting->value = "all" ;
                        break ;
                    }
                }

                $check = true  ;
            }
        }
        else if($setting->type_id =='7')
        {
          $setting->value = $request->value;
          $check = true ;
        }

        $setting->key = $request->key;
        if (!$check)
        {

            if (!empty($request->value)){
                $setting->value = $request->value;}
            else{
                \Session::flash('failed','No changes takes place');
                return redirect('setting');
            }
        }

        $setting->save();
        $request->session()->flash('success', 'updated successfully');

        return redirect('setting');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::findOrfail($id);
        if (file_exists($setting->value))
        {
            unlink($setting->value);
        }
        $setting->delete();
        \Session::flash('success', 'deleted successfully');
        return back();
    }

    //Function To Order Settings Tables
    public function updateOrder(Request $request)
    {
        $settings = Setting::all();

        foreach($settings as $setting)
        {
            $setting->timestamps = false; //To Disable Updated At

            $id = $setting->id; // Get The ID Of Content

            foreach($request->order as $order)
            {
                if($order['id'] == $id) //Update When ID = Content ID
                {
                    $setting->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200); // Return Json Response "Success"
    }
}
