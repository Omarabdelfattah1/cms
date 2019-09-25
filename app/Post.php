<?php

namespace App;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{

	use SoftDeletes;

  protected $dates=[
    'published_at'
  ];
  protected $fillable=[
  	           'title',
                 'description',
                 'content',
                 'image',
                 'published_at',
                 'deleted_at',
                 'category_id',
                 'user_id'
              ];
  public function deleteImage()
  {
  	Storage::delete($this->image);
  }

  public function category()
  {
  	return $this->belongsTo(Category::class);
  }

  public function tags(){
      return $this->belongsToMany(Tag::class);
  }

  public function hasTag($tagID)
  {
      return in_array($tagID, $this->tags->pluck('id')->toArray());
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopeSearched($query)
  {

    $search=request()->query('search');

    if (!$search) {
      return $query->published();
    }else{
      return $query->published()->where('title','LIKE','%{$search}%');
    }
  }

  public function scopePublished($query)
  {

    return $query->where('published_at','<=',now());
  }
}
