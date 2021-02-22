<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Provider;
use Validator;
class CategoryController extends Controller
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
        $categorys = Category::whereNull('parent_id')->get();
        return view('category.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = null;
        $providers = Provider::all();
        return view('category.form',compact('category','providers'));
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
                  'title' => 'required|string',
                  'image' => ''
          ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->image)
        {
          $imgExtensions = array("png","jpeg","jpg");
          $file = $request->image;
          if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
          {
              \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
              return back();
         }
       }

      $category = Category::create($request->all());

      \Session::flash('success', 'Category Created Successfully');
      return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $contents = $category->contents;
        return view('content.index',compact('contents','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $providers = Provider::all();
        return view('category.form',compact('category','providers'));
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
                  'title' => 'required|string',
                  'image' => ''
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }
      $category = Category::findOrFail($id);

      if($request->image){
        $imgExtensions = array("png","jpeg","jpg");
        $file = $request->image;
        if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
        {
            \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
            return back();
       }
        $this->delete_image_if_exists(base_path('/uploads/category/'.basename($category->image)));
      }

      $category->update($request->all());

      \Session::flash('success', 'Category Updated Successfully');
      return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::findOrFail($id);

      if($category->image){
        $this->delete_image_if_exists(base_path('/uploads/category/'.basename($category->image)));
      }
      $category->delete();

      \Session::flash('success', 'Category Delete Successfully');
      return back();
    }
}
