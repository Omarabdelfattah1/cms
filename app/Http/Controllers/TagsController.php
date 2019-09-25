<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index')->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

        $tag=new Tag;

        $tag->name=$request['name'];
        $tag->save();

        /* OR)
            Tag::create([
                'name'=>$request->name
            ])

        */
        session()->flash('success','Tag created successfully !');
        return Redirect(Route('tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        if ($request->name!==$tag->name) {
            $tag->name=$request->name;
            $tag->save();
            
        }
        

        
        session()->flash('success','Tag updated successfully !');
        return Redirect(Route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->posts->count()) {
            session()->flash('error','This Tag can not be deleted ,Because it is associated some posts');
            return redirect()->back();

        }
        $tag->delete();

        session()->flash('success' , 'Tag deleted successfully .');

        return redirect(route('tags.index'));
    }
}
