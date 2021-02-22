@if(isset($_REQUEST['category_id']))
<div class="form-group">
    <label for="textfield5" class="col-sm-3 col-lg-2 control-label">Category<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        <select  name="parent_id" class="form-control chosen-rtl">
            <option id="category_{{ $_REQUEST['category_id'] }}" value="{{ $_REQUEST['category_id'] }}">{{ $_REQUEST['title']}}</option>
        </select>
    </div>
</div>
@else
<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Category<span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::select('parent_id',$parents->pluck('title','id'),null,['class'=>'form-control chosen-rtl','required']) !!}
    </div>
</div>
@endif

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Title <span class="text-danger">*</span></label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('title',null,['placeholder'=>'Title','class'=>'form-control input-lg']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-md-2 control-label">Image</label>
    <div class="col-sm-9 col-md-8 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                @if($category)
                    <img src="{{$category->image}}" alt="" />
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
            </div>
            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
                <span class="btn btn-file"><span class="fileupload-new">@lang('messages.select_image')</span>
                    <span class="fileupload-exists">Change</span>
                    {!! Form::file('image',["accept"=>"image/*" ,"class"=>"default"]) !!}
                </span>
                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
        </div>
        <span class="label label-important">NOTE!</span>
        <span>Only extensions supported png, jpg, and jpeg</span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::submit($buttonAction,['class'=>'btn btn-primary']) !!}
    </div>
</div>
