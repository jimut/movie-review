<?php

namespace App\Http\Controllers;

use SearchIndex;
use File;
use Image;
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
        'except' => ['index' ,'show', 'search']
      ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $movies = Movie::orderBy('created_at', 'desc')->get();

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

    $imageName = 'missing.jpg';
    if ($request->hasFile('image')) {
      $imageName = $this->storeImage($request->file('image'));
    }

    $movie = new Movie;
    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->movie_length = $request->movie_length;
    $movie->director = $request->director;
    $movie->rating = $request->rating;
    $movie->image = $imageName;
    $movie->user_id = $request->user()->id;
    $movie->save();

    SearchIndex::upsertToIndex($movie);

    return redirect()->route('movie.show', [$movie])
                     ->with('notice', 'Movie Created');
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

    if ($request->hasFile('image')) {
      $imageName = $this->storeImage($request->file('image'));
      if ($movie->image != 'missing.jpg') File::delete(public_path('uploads/movies/img/') . $movie->image);
      $movie->image = $imageName;
    }

    $movie->title = $request->title;
    $movie->description = $request->description;
    $movie->movie_length = $request->movie_length;
    $movie->director = $request->director;
    $movie->rating = $request->rating;
    $movie->save();

    SearchIndex::upsertToIndex($movie);

    return redirect()->route('movie.show', [$movie])
                     ->with('notice', 'Movie Updated');
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

    if ($movie->image != 'missing.jpg') File::delete(public_path('uploads/movies/img/') . $movie->image);
    $movie->delete();

    return redirect('movie');
  }

  private function storeImage ($image) {
    $imageName = md5($image->getClientOriginalName() . microtime())
                  . '.' . $image->getClientOriginalExtension();

    Image::make($image)
            ->resize(800, null, function ($constraint) {
              $constraint->aspectRatio();
            })
            ->save(public_path('uploads/movies/img/') . $imageName);

    return $imageName;
  }

  public function search (Request $request) {
    $query = [
      'index' => 'moviereview',
      'body' => [
        'query' => [
          'match_phrase' => [
            'title' => $request->q
          ]
        ]
      ]
    ];

    $result = SearchIndex::getResults($query);

    $movies = null;
    foreach ($result['hits']['hits'] as $movie) {
      $movies[] = Movie::find($movie['_id']);
    }

    return view('movie.index', [
      'movies' => $movies,
    ]);
  }
  
}
