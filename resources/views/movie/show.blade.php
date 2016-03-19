@extends('layouts.app')

@section('content')

<ul>
  <li>{{ $movie->title }}</li>
  <li>{{ $movie->description }}</li>
  <li>{{ $movie->movie_length }}</li>
  <li>{{ $movie->director }}</li>
  <li>{{ $movie->rating }}</li>
</ul>

<a href="{{ route('movie.edit', [$movie]) }}">Edit</a>
<form action="{{ route('movie.destroy', [$movie]) }}"
      method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <button type="submit">Delete</button>
</form>

@endsection
