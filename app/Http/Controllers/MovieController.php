<?php

namespace App\Http\Controllers;

use Gate;
use App\Movie;
use Illuminate\Http\Request;

use App\Http\Requests;

class MovieController extends Controller
{
  /**
   * Holds the validation array for storing and updating
   *
   * @var array $rules
   */
  private $rules = [
    'title' => 'required|min:6',
    'description' => 'required|min:6',
    'movie_length' => 'required',
    'director' => 'required',
    'rating' => 'required',
  ];

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth', [
        'except' => ['index' ,'show']
      ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $movies = Movie::all();

    return view('movie.index', [
      'movies' => $movies,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('movie.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, $this->rules);

    $movie = new Movie;
    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->movie_length = $request->movie_length;
    $movie->director = $request->director;
    $movie->rating = $request->rating;
    $movie->user_id = $request->user()->id;
    $movie->save();

    return redirect()->route('movie.show', [$movie]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $movie = Movie::find($id);

    return view('movie.show', [
      'movie' => $movie,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $movie = Movie::find($id);

    if (Gate::denies('modify', $movie)) {
      abort(403);
    }

    return view('movie.edit', [
      'movie' => $movie,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $movie = Movie::find($id);

    if (Gate::denies('modify', $movie)) {
      abort(403);
    }

    $this->validate($request, $this->rules);

    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->movie_length = $request->movie_length;
    $movie->director = $request->director;
    $movie->rating = $request->rating;
    $movie->save();

    return redirect()->route('movie.show', [$movie]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $movie = Movie::find($id);

    if (Gate::denies('modify', $movie)) {
      abort(403);
    }

    $movie->delete();

    return redirect('movie');
  }
}
