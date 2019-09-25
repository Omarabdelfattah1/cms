<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image=$request->image->store('products');
        $post=Post::create([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'content'=>$request->content,
                    'image'=>$image,
                    'published_at'=>$request->published_at,
                    'category_id'=>$request->category,
                    'user_id'=>auth()->user()->id,
                ]);
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return Redirect(Route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        $image=is_null($request->image)?$post->image:$request->image->store('posts');;
        if (!is_null($request->image)) {
            $post->deleteImage();
        }
        
        if ($request->tags) {

            /*
             *
             * update tags to the new selected ones 
             */
            $post->tags()->sync($request->tags);
        }

        $post->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'content'=>$request->content,
                    'published_at'=>$request->published_at,
                    'image'=>$image,
                    'category_id'=>$request->category,
                    'user_id'=>auth()->user()->id,
                ]);

        
        return Redirect(Route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post=Post::withTrashed()->where('id',$id)->firstOrfail();
        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();

        }else{
            $post->delete();

        }

        session()->flash('success' , 'Post deleted successfully .');

        return redirect(route('posts.index'));
    }
    public function trashed(){
        $posts=Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($posts);
    }

    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->firstOrfail();

        $post->restore();

        session()->flash('success' , 'Post restored successfully .');        
         return redirect()->back();
    }

    
}