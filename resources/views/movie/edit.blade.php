@extends('layouts.app')

@section('content')

  @include('common.errors')

  <form action="{{ route('movie.update', [$movie]) }}"
        method="POST">

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <label for="title">Title</label>
    <input type="text"
            name="title"
            id="title"
            value="{{ $movie->title }}">

    <label for="description">Description</label>
    <textarea type="text"
            name="description"
            id="description">
            {{ $movie->description }}
    </textarea>

    <label for="movie_length">Movie Length</label>
    <input type="text"
            name="movie_length"
            id="movie_length"
            value="{{ $movie->movie_length }}">

    <label for="director">Director</label>
    <input type="text"
            name="director"
            id="director"
            value="{{ $movie->director }}">

    <label for="rating">Rating</label>
    <input type="text"
            name="rating"
            id="rating"
            value="{{ $movie->rating }}">

    <button type="submit">Submit</button>

  </form>

@endsection
