<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Operator;
use App\Country;
use Validator;
class OperatorController extends Controller
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
        $operators = Operator::all();
        return view('operator.index',compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::all();
        $operator = NULL;
        return view('operator.form',compact('countrys','operator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                  'name' => 'required|string|unique:operators,name,null,id,country_id,'.$request->country_id,
                  'country_id' => 'required'
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      $operator = Operator::create($request->all());

      \Session::flash('success', 'Operator Created Successfully');
      return redirect('/operator');
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
      $operator = Operator::findOrFail($id);
      $countrys = Country::all();
      return view('operator.form',compact('operator','countrys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      //dd($request->all());
      $validator = Validator::make($request->all(), [
                  'name' => 'required|string|unique:operators,name,'.$id.',id,country_id,'.$request->country_id,
                  'country_id' => 'required'
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      $operator = Operator::findOrFail($id);

      if($request->image){
        $this->delete_image_if_exists(base_path('/uploads/operator/'.$operator->image));
      }

      $operator->update($request->all());
      \Session::flash('success', 'Operator Update Successfully');
      return redirect('/operator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $operator = Operator::findOrFail($id);

      if($operator->image){
        $this->delete_image_if_exists(base_path('/uploads/operator/'.$operator->image));
      }
      $operator->delete();

      \Session::flash('success', 'Operator Delete Successfully');
      return back();
    }
}
