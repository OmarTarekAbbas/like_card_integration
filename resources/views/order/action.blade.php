<td>
  <a class="btn btn-sm show-tooltip" title="show_product" href="{{url("order/".$order->id)}}" data-original-title="show order"><i class="fa fa-step-forward"></i></a>
  @if (Auth::user()->id == 1)
  <a class="btn btn-sm show-tooltip btn-danger" onclick="return ConfirmDelete();" href="{{url("order/$order->id/delete")}}" title="@lang('messages.template.delete')"><i class="fa fa-trash"></i></a>
  @endif
</td>
