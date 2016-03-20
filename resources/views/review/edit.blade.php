@extends('layouts.app')

@section('content')

  <h1>New Review</h1>

  @include('common.errors')

  <form action="{{ route('movie.review.update', [$movie, $review]) }}"
        method="POST">

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <label for="rating">Rating</label>
    <input type="text"
           name="rating"
           id="rating"
           value="{{ $review->rating }}">

    <br>

    <label for="comment">Comment</label>
    <textarea type="text"
           name="comment"
           id="comment">
           {{ $review->comment }}
    </textarea>

    <br>

    <button type="submit">Submit</button>

  </form>

@endsection
