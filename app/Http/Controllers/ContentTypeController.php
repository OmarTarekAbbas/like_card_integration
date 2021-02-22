<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ContentType;
use Validator;
class ContentTypeController extends Controller
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
        $content_types = ContentType::all();
        return view('content_type.index',compact('content_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $content_type = null;
        return view('content_type.form',compact('content_type'));
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
                  'title' => 'required|string'
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      $content_type = ContentType::create($request->all());

      \Session::flash('success', 'ContentType Created Successfully');
      return redirect('/content_type');
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
        $content_type = ContentType::findOrFail($id);
        return view('content_type.form',compact('content_type'));
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
      $validator = Validator::make($request->all(), [
                  'title' => 'required|string'
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }
      $content_type = ContentType::findOrFail($id);
      $content_type->update($request->all());

      \Session::flash('success', 'ContentType Updated Successfully');
      return redirect('/content_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $content_type = ContentType::findOrFail($id);


      $content_type->delete();

      \Session::flash('success', 'ContentType Delete Successfully');
      return back();
    }
}
