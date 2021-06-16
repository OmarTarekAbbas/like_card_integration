<td class="visible-xs visible-sm visible-md visible-lg">
                  <div class="btn-group">
                    <a class="btn btn-sm btn-warning show-tooltip" title="Show Order" href="{{url("order?client_id=$client->id")}}" data-original-title="show Order"><i class="fa fa-step-forward"></i></a>
                    @if(get_setting('enable_delete'))
                    <a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('client/'.$client->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                    @endif
                  </div>
                </td>
