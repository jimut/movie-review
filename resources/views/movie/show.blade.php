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
          </div>
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

@endsection
