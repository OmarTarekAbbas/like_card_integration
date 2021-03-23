@extends("front.master")

@section("content")
<section class="grid_card">
  <div class="row m-0">
    @forelse($category->childs as $child)
    <div class="col-4 collPadding">
      <div class="card">
        <a class="linkable" href="{{ getUrl($child) }}">
          <img class="card_img m-auto d-block" src="{{ $child->amazonImage }}" alt="itunes">

          <div class="card-body text-center">
            <p class="card-text">{{ $child->categoryName }}</p>
          </div>
        </a>
      </div>
    </div>
    @else
    <div class="panel">
        <h3>Not Found</h3>
    </div>
    @endforelse
  </div>
</section>
@stop
