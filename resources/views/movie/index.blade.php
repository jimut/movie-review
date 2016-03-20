@extends('layouts.app')

@section('content')

  <table>
    <thead>
      <tr>
        <td>Title</td>
        <td>Description</td>
        <td>Movie Length</td>
        <td>Director</td>
        <td>Rating</td>
        <td>Owner</td>
        <td>Poster</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($movies as $movie)
        <tr>
          <td><a href="{{ route('movie.show', [$movie]) }}">{{ $movie->title }}</a></td>
          <td>{{ $movie->description }}</td>
          <td>{{ $movie->movie_length }}</td>
          <td>{{ $movie->director }}</td>
          <td>{{ $movie->rating }}</td>
          <td>{{ $movie->user->name }}</td>
          <td><img src="{{ url('imagecache/small/' . $movie->image) }}" alt=""></td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
