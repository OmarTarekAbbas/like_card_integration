<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Content;
use App\ContentType;
use App\Category;
use Validator;
use FFMpeg;
class ContentController extends Controller
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
        $contents      = Content::all();
        return view('content.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categorys     = Category::all();
      $content_types = ContentType::all();
      $content       = NULL;
      return view('content.form',compact('categorys','content_types','content'));
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
                  'content_type_id' => 'required',
                  'category_id' => 'required',
                  'path' => 'required',
                  'image_preview' => ''
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      if($request->content_type_id == 3)
      {
        $imgExtensions = array("png","jpeg","jpg");
        $file = $request->path;
        if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
        {
            \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
            return back();
        }
      }
      else if($request->content_type_id == 4)
      {
        $audExtensions = array("mp3","webm","wav");
        $file = $request->path;
        if(! in_array($file->getClientOriginalExtension(),$audExtensions))
        {
            \Session::flash('failed','Audio must be mp3, webm and wav only !! No updates takes place, try again with that extensions please..');
            return back() ;
        }
      }
      else if($request->content_type_id ==5)
      {
        $vidExtensions = array("mp4","flv","3gp");
        $file = $request->path;
        if(! in_array($file->getClientOriginalExtension(),$vidExtensions))
        {
            \Session::flash('failed','Video must be mp4, flv, or 3gp only !! No updates takes place, try again with that extensions please..');
            return back();
        }
        if(!$request->image_preview)
        {
          $ffmpeg = FFMpeg\FFMpeg::create();
          $video = $ffmpeg->open($request->path);
          $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
          $image_name = time().rand(0,999);
          $image_preview = base_path('/uploads/content/image/'.$image_name.'.jpg');
          $request->request->add(['image_preview' => $image_name]);
          $frame->save($image_preview);
        }
      }

      else if($request->content_type_id ==6)
      {
        if(filter_var($request->path, FILTER_VALIDATE_URL) == false)
        {
          \Session::flash('failed','The Content Must be Valid Url');
          return back();
        }

        if(!$request->image_preview)
        {
          $image_name = time().rand(0,999);
          $link = explode('embed/',$request->path);
          if(isset($link[1]))
          {
            $y_id = explode('?',$link[1]);
            file_put_contents(base_path('/uploads/content/image/'.$image_name.'.jpg') , file_get_contents('http://img.youtube.com/vi/'.$y_id[0].'/maxresdefault.jpg'));
          }
          else
          {
            $link = explode('?v=',$request->path);
            file_put_contents(base_path('/uploads/content/image/'.$image_name.'.jpg') , file_get_contents('http://img.youtube.com/vi/'.$link[1].'/maxresdefault.jpg'));
            $request->request->add(['path' => 'http://www.youtube.com/embed/'.$link[1].'?rel=0']);
          }
          $request->request->add(['image_preview' => $image_name]);
        }

      }
      $content = Content::create($request->all());

      \Session::flash('success', 'Content Created Successfully');
      return redirect('category/'.$request->category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $content = Content::findOrFail($id);
      return view('content.show_post',compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $categorys     = Category::all();
      $content_types = ContentType::all();
      $content       = Content::findOrFail($id);
      return view('content.form',compact('categorys','content_types','content'));
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
                  'content_type_id' => 'required',
                  'category_id' => 'required',
                  'path' => '',
                  'image_preview' => ''
          ]);

      if ($validator->fails()) {
          return back()->withErrors($validator)->withInput();
      }

      $content = Content::findOrFail($id);

      if($request->image_preview){
        $this->delete_image_if_exists(base_path('/uploads/content/image/'.basename($content->image_preview)));
      }

      if($request->path){
          if($request->content_type_id == 3)
          {
            $imgExtensions = array("png","jpeg","jpg");
            $file = $request->path;
            if(! in_array($file->getClientOriginalExtension(),$imgExtensions))
            {
                \Session::flash('failed','Image must be jpg, png, or jpeg only !! No updates takes place, try again with that extensions please..');
                return back();
            }
          }
          else if($request->content_type_id == 4)
          {
            $audExtensions = array("mp3","webm","wav");
            $file = $request->path;
            if(! in_array($file->getClientOriginalExtension(),$audExtensions))
            {
                \Session::flash('failed','Audio must be mp3, webm and wav only !! No updates takes place, try again with that extensions please..');
                return back() ;
            }
          }
          else if($request->content_type_id ==5)
          {
            $vidExtensions = array("mp4","flv","3gp");
            $file = $request->path;
            if(! in_array($file->getClientOriginalExtension(),$vidExtensions))
            {
                \Session::flash('failed','Video must be mp4, flv, or 3gp only !! No updates takes place, try again with that extensions please..');
                return back();
            }
            if(!$request->image_preview)
            {
              $ffmpeg = FFMpeg\FFMpeg::create();
              $video = $ffmpeg->open($request->path);
              $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
              $image_name = time().rand(0,999);
              $image_preview = base_path('/uploads/content/image/'.$image_name.'.jpg');
              $request->request->add(['image_preview' => $image_name]);
              $frame->save($image_preview);
              //delete old image_preview
              if($content->image_preview){
                $this->delete_image_if_exists(base_path('/uploads/content/image/'.basename($content->image_preview)));
              }
            }
            //delete ol path
            $this->delete_image_if_exists(base_path('/uploads/content/path/'.basename($content->path)));
          }
          else if($request->content_type_id ==6)
          {
            if(filter_var($request->path, FILTER_VALIDATE_URL) == false)
            {
              \Session::flash('failed','The Content Must be Valid Url');
              return back();
            }

            if(!$request->image_preview)
            {
              $image_name = time().rand(0,999);
              $link = explode('embed/',$request->path);
              if(isset($link[1]))
              {
                $y_id = explode('?',$link[1]);
                file_put_contents(base_path('/uploads/content/image/'.$image_name.'.jpg') , file_get_contents('http://img.youtube.com/vi/'.$y_id[0].'/maxresdefault.jpg'));
              }
              else
              {
                $link = explode('?v=',$request->path);
                file_put_contents(base_path('/uploads/content/image/'.$image_name.'.jpg') , file_get_contents('http://img.youtube.com/vi/'.$link[1].'/maxresdefault.jpg'));
                $request->request->add(['path' => 'http://www.youtube.com/embed/'.$link[1].'?rel=0']);
              }
              $request->request->add(['image_preview' => $image_name]);
              //delete old image_preview
              if($content->image_preview){
                $this->delete_image_if_exists(base_path('/uploads/content/image/'.basename($content->image_preview)));
              }
            }

          }
      }



      $content->update($request->all());

      \Session::flash('success', 'Content Updated Successfully');
      return redirect('category/'.$request->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $content = Content::findOrFail($id);

      if($content->image_preview){
        $this->delete_image_if_exists(base_path('/uploads/content/image/'.basename($content->image_preview)));
      }

      if($content->path){
        $this->delete_image_if_exists(base_path('/uploads/content/path/'.basename($content->path)));
      }

      $content->delete();

      \Session::flash('success', 'Content Delete Successfully');
      return back();
    }
}
