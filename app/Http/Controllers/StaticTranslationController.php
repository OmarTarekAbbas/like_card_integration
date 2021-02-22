<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\StaticTranslation;
use App\Language;
use Validator;

class StaticTranslationController extends Controller
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
        $static_translations = StaticTranslation::all();
        $languages = Language::all();
        return view('static_translation.index',compact('static_translations','languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('static_translation.create',compact('languages'));
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
                        "key_word" => "required",
                        'translations' => 'required'
                    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $static_translation = new StaticTranslation();
        $static_translation->key_word = $request->key_word;
        $static_translation->save();

        foreach ($request->translations as $key => $value) {
            $static_translation->languages()->attach($key,['body'=>$value]);
        }
        $request->session()->flash('success', 'Created Successfully');
        return redirect('static_translation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $static_translation = StaticTranslation::find($id);
        $languages = Language::all();
        return view('static_translation.view',compact('languages','static_translation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $static_translation = StaticTranslation::find($id);
        $languages = Language::all();
        return view('static_translation.create',compact('languages','static_translation'));
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
                        "key_word" => "required",
                        'translations' => 'required'
                    ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $static_translation = StaticTranslation::find($id);
        $static_translation->key_word = $request->key_word;
        $static_translation->save();
        $static_translation->languages()->sync([]);
        foreach ($request->translations as $key => $value) {
            $static_translation->languages()->attach($key,['body'=>$value]);
        }
        $request->session()->flash('success', 'Created Successfully');
        return redirect('static_translation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $static_translation = StaticTranslation::find($id);
        $static_translation->delete();
        $request->session()->flash('success', 'Deleted Successfully');
        return redirect('static_translation');
    }
}
