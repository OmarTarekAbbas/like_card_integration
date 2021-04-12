@if(count($errors)>0)
<div class="alert alert_danger text-capitalize">
  <ul class="mb-0">
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
