<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Review;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReviewController extends Controller
{
  /**
   * Holds the validation array for storing and updating
   *
   * @var array $rules
   */
  private $rules = [
    'rating' => 'required',
    'comment' => 'required',
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Movie $movie)
  {
    return view('review.create', [
      'movie' => $movie,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Movie $movie)
  {
    $this->validate($request, $this->rules);

    $review = new Review;
    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $review->movie_id = $movie->id;
    $review->save();

    return redirect()->route('movie.show', [$movie]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Movie $movie, $id)
  {
    $review = Review::find($id);

    return view('movie.review.edit', [
      'movie' => $movie,
      'review' => $review,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Movie $movie, $id)
  {
    $this->validate($request, $rules);

    $review = Review::find($id);

    $review->rating = $request->rating;
    $review->comment = $request->comment;
    $revie->save();

    return redirect()->route('movie.show', [$movie]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie, $id)
  {
    $review = Review::find($id);

    $review->delete();

    return redirect('movie.show', [$movie]);
  }
}
