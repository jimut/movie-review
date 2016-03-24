@extends('layouts.app')

@section('content')

  @if (Auth::guest())
    <div class="jumbotron">
      <h1>Your Favorite Movies Reviewed</h1>
      <p>Disrupt occupy bespoke raw denim. Organic direct trade synth, four dollar toast vegan pitchfork lo-fi yuccie hammock green juice. Hoodie leggings selvage YOLO, offal cronut disrupt typewriter. </p>
      <p><a href="{{ url('register') }}" class="btn btn-primary btn-lg">Sign Up To Write A Review</a></p>
    </div>
  @endif

  @if ($movies)
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
  @endif

@endsection
