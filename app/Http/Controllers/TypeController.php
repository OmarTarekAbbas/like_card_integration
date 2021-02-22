<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Auth;
use App\Http\Requests;
use App\Http\Requests\TypeRequest;
use App\Http\Controllers\Controller;

class TypeController extends Controller
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
        $types = Type::all();
        return view('types/index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = null;
        return view('types.input',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
         $type =  new Type();
         $type->title = $request->title;
         \Session::flash('success','Type Added Successfully');
         $type->save() ;
         return redirect('types/index');
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
        $type = Type::findOrFail($id) ;
        return view('types.input',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $id)
    {
        $oldtype = Type::findOrfail($id);
        $newtype = $request->all();
        $oldtype->update($newtype);
        \Session::flash('success','Type Updated successfully');
        return redirect('types/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('super_admin'))
        {
           $type = Type::findOrfail($id);
           $type->delete();
           \Session::flash('success','Type has been Deleted Successfully');
           return redirect('types/index');
        }
    }
}
