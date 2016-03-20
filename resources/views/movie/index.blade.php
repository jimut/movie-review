@extends('layouts.app')

@section('content')

  @if (Auth::guest())
    <div class="jumbotron">
      <h1>Your Favorite Movies Reviewed</h1>
      <p>Disrupt occupy bespoke raw denim. Organic direct trade synth, four dollar toast vegan pitchfork lo-fi yuccie hammock green juice. Hoodie leggings selvage YOLO, offal cronut disrupt typewriter. </p>
      <p><a href="{{ url('register') }}" class="btn btn-primary btn-lg">Sign Up To Write A Review</a></p>
    </div>
  @endif

  <div class="row">
    @foreach ($movies as $movie)

      <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          <a href="{{ route('movie.show', [$movie]) }}" class="image">
            <img src="{{ url('imagecache/poster/' . $movie->image) }}">
          </a>
        </div>
      </div>

    @endforeach
  </div>

  <!-- <table>
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
  </table> -->

@endsection
