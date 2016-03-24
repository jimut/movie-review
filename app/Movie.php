<?php

namespace App;

use Spatie\SearchIndex\Searchable;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model implements Searchable
{
  public function user () {
    return $this->belongsTo('App\User');
  }

  public function reviews () {
    return $this->hasMany('App\Review');
  }

  /**
   * Returns an array with properties which must be indexed
   *
   * @return array
   */
  public function getSearchableBody()
  {
    $searchableProperties = [
      'title' => $this->title,
    ];

    return $searchableProperties;

  }

  /**
   * Return the type of the searchable subject
   *
   * @return string
   */
  public function getSearchableType()
  {
    return 'movie';
  }

  /**
   * Return the id of the searchable subject
   *
   * @return string
   */
  public function getSearchableId()
  {
    return $this->id;
  }
}
