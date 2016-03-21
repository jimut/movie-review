@extends('layouts.app')

@section('content')

  <h1>New Review</h1>

  @include('common.errors')

  <form action="{{ route('movie.review.store', [$movie]) }}"
        method="POST">

    {{ csrf_field() }}

    <div class="star-rating"></div>

    <br>

    <label for="comment">Comment</label>
    <textarea type="text"
           name="comment"
           id="comment">{{ old('comment') }}</textarea>

    <br>

    <button type="submit">Submit</button>

  </form>

  <script>
    $('.star-rating').raty({
      path: '{{ url("includes/raty-master/images/") }}',
      scoreName: 'rating'
    });
  </script>

@endsection
