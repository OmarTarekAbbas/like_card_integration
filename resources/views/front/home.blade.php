@extends("front.master")

@section("content")
<section class="grid_card">
  <div class="row m-0">
    @forelse(categories() as $category)
    <div class="col-4 collPadding">
      <div class="home-card">
        <a class="linkable" href="{{ route('front.category', ['parent_id' => $category->id]) }}">
          <img class="card_img m-auto d-block" src="{{ $category->amazonImage }}" alt="{{ $category->categoryName }}">

          <div class="card-body text-center">
            <p class="card-text">{{ $category->categoryName }}</p>
          </div>
        </a>
      </div>
    </div>
    @empty
    <div class="panel">
        <h3>Not Found</h3>
    </div>
    @endforelse
  </div>
</section>
@stop
