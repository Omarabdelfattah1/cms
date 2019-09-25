<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
    	$posts=Post::searched()->simplePaginate(4);
    	return view('welcome')
    	->with('posts',$posts)
    	->with('tags',Tag::all())
    	->with('categories',Category::all());
    }

    public function category(Category $category)
    {
    	$posts=$category->posts()->searched()->simplePaginate(4);

    	return view('posts.category')
    	->with('posts',$posts)
    	->with('tags',Tag::all())
    	->with('category',$category)
    	->with('categories',Category::all()); 
    }

    public function tag(Tag $tag)
    {
    	$posts=$tag->posts()->searched()->simplePaginate(4);
    	
    	
    	return view('posts.tag')
    	->with('posts',$posts)
    	->with('tag',$tag)
    	->with('tags',Tag::all())
    	->with('categories',Category::all());    
    }
}
