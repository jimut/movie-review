@extends('layouts.app')

@section('content')

  @include('common.errors')

  <form action="{{ route('movie.store') }}"
        method="POST"
        enctype="multipart/form-data">

    {{ csrf_field() }}

    <label for="title">Title</label>
    <input type="text"
            name="title"
            id="title"
            value="{{ old('title') }}">

    <br>
    <label for="description">Description</label>
    <textarea type="text"
            name="description"
            id="description">
            {{ old('description') }}
    </textarea>

    <br>
    <label for="movie_length">Movie Length</label>
    <input type="text"
            name="movie_length"
            id="movie_length"
            value="{{ old('movie_length') }}">

    <br>
    <label for="director">Director</label>
    <input type="text"
            name="director"
            id="director"
            value="{{ old('director') }}">

    <br>
    <label for="rating">Rating</label>
    <input type="text"
            name="rating"
            id="rating"
            value="{{ old('rating') }}">

    <br>
    <label for="image">Image</label>
    <input type="file"
            name="image"
            id="image"
            accept="image/*">

    <br>
    <button type="submit">Submit</button>

  </form>

@endsection
