@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4">
          <img src="{{ url('imagecache/poster/'. $movie->image) }}">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td><strong>Title</strong></td>
                  <td>{{ $movie->title }}</td>
                </tr>
                <tr>
                  <td><strong>Description</strong></td>
                  <td>{{ $movie->description }}</td>
                </tr>
                <tr>
                  <td><strong>Movie length</strong></td>
                  <td>{{ $movie->movie_length }}</td>
                </tr>
                <tr>
                  <td><strong>Director</strong></td>
                  <td>{{ $movie->director }}</td>
                </tr>
                <tr>
                  <td><strong>Rating</strong></td>
                  <td>{{ $movie->rating }}</td>
                </tr>
              </tbody>
            </table>

            <a href="{{ route('movie.review.create', [$movie]) }}">Write a Review</a>
          </div>
        </div>
        <div class="col-md-7 col-md-offset-1">
          <h1 class="review_title">{{ $movie->title }}</h1>
          <p>{{ $movie->description }}</p>

          @if (count($movie->reviews) > 0)

            @foreach ($movie->reviews()->orderBy('created_at', 'desc')->get() as $review)
              <div class="reviews">
                <div class="star-rating" data-score="{{ $review->rating }}"></div>
                <p>{{ $review->comment }}</p>
              </div>
            @endforeach

          @else

            <h3>No reviews just yet, would you like to add the first!</h3>
            <a href="{{ route('movie.review.create', [$movie]) }}" class="btn btn-danger">Write Review</a>

          @endif
        </div>
      </div>
    </div>
  </div>

  @can ('modify', $movie)
    <a href="{{ route('movie.edit', [$movie]) }}">Edit</a>
    <form action="{{ route('movie.destroy', [$movie]) }}"
          method="POST">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit">Delete</button>
    </form>
  @endcan

  <script>
    $('.star-rating').raty({
      path: '{{ url("includes/raty-master/images/") }}',
      readOnly: true,
      score: function () {
        return $(this).attr('data-score');
      }
    });
  </script>

@endsection
