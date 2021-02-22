@extends('template')
@section('page_title')
 @if(isset($category)) {{$category->title}} @else Content @endif
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-black">
                    <div class="box-title">
                        <h3><i class="fa fa-table"></i> Content Table</h3>
                        <div class="box-tool">
                            <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                            <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="btn-toolbar pull-right">
                            <div class="btn-group">
                                <a class="btn btn-circle show-tooltip" title="" href="{{url('content/create')}}" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                                <?php
                                $table_name = "contents";
                                // pass table name to delete all function
                                // if the current route exists in delete all table flags it will appear in view
                                // else it'll not appear
                                ?>
                                @include('partial.delete_all')
                            </div>
                        </div>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:18px"><input type="checkbox" onclick="select_all('contents')"></th>
                                        <th>id</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        @if(!isset($category))
                                        <th>Category</th>
                                        @endif
                                        <th>Content Type</th>
                                        <th>patch number</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contents as $value)
                                    <tr>
                                        <td><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$value->id}}" class="roles" onclick="collect_selected(this)"></td>
                                        <td>{{$value->id}}</td>
                                        <td>
                                            {{$value->title}}
                                        </td>
                                        <td>
                                          @if($value->type->id == 1)
                                          {!! $value->path !!}
                                          @elseif($value->type->id == 2)
                                          {{$value->path}}
                                          @elseif($value->type->id == 3)
                                          <img src="{{$value->path}}" alt="" style="width:250px" height="200px">
                                          @elseif($value->type->id == 4)
                                          <audio controls src="{{$value->path}}" style="width:100%"></audio>
                                          @elseif($value->type->id == 5)
                                          <video src="{{$value->path}}" style="width:250px;height:200px" height="200px" controls poster="{{$value->image_preview}}"></video>
                                          @elseif($value->type->id == 6)
                                          <iframe src="{{$value->path}}" width="250px" height="200px"></iframe>
                                          @endif
                                        </td>
                                        @if(!isset($category))
                                        <td>
                                            {{$value->category->title}}
                                        </td>
                                        @endif
                                        <td>{{$value->type->title}}</td>
                                        <td>{{$value->patch_number}}</td>
                                        <td class="visible-md visible-lg">
                                            <div class="btn-group">
                                                @if (get_action_icons('post/create', 'get'))
                                                <a class="btn btn-sm btn-success show-tooltip" title="Add Post" href="{{url("post/create?content_id=".$value->id."&title=".$value->title)}}" data-original-title="Add Post"><i class="fa fa-plus"></i></a>
                                                @endif
                                                @if (get_action_icons('content/{id}', 'get'))
                                                @if(count($value->operators) > 0)
                                                <a class="btn btn-sm show-tooltip" title="Show Posts" href="{{url("content/$value->id")}}" data-original-title="show Posts"><i class="fa fa-step-forward"></i></a>
                                                @endif
                                                @endif
                                                @if (get_action_icons('content/{id}/edit', 'get'))
                                                <a class="btn btn-sm show-tooltip" href="{{url("content/$value->id/edit")}}" title="Edit"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if (get_action_icons('content/{id}/delete', 'get'))
                                                <a class="btn btn-sm show-tooltip btn-danger" onclick="return ConfirmDelete();" href="{{url("content/$value->id/delete")}}" title="Delete"><i class="fa fa-trash"></i></a>
                                                @endif
                                                @if (get_action_icons('rbt/create', 'get'))
                                                @if($value->type->id == 4)
                                                <a class="btn btn-sm btn-info show-tooltip" title="Add Rbt" href="{{url("rbt/create?content_id=".$value->id."&title=".$value->title)}}" data-original-title="Add RBt"><i class="fa fa-plus"></i></a>
                                                @endif
                                                @endif
                                                @if (get_action_icons('rbt/{id}', 'get'))
                                                @if(count($value->rbt_operators) > 0)
                                                <a class="btn btn-sm show-tooltip" title="Show Rbt Code" href="{{url("rbt/$value->id")}}" data-original-title="show RBt_code"><i class="fa fa-step-forward"></i></a>
                                                @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@stop

@section('script')
<script>

    $('#contents').addClass('active');
    $('#contents_index').addClass('active');

</script>
@stop
