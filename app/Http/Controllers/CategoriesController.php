<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

        $category=new Category;

        $category->name=$request['name'];
        $category->save();

        /* OR)
            Category::create([
                'name'=>$request->name
            ])

        */
        session()->flash('success','Category created successfully !');
        return Redirect(Route('categories.index'));
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
    public function edit(Category $category)
    {
        return view('categories.create')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->name!==$category->name) {
            $category->name=$request->name;
            $category->save();
            
        }
        

        
        session()->flash('success','Category updated successfully !');
        return Redirect(Route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->posts->count()) {
            session()->flash('error','This Category can not be deleted ,Because it has some posts');
            return redirect()->back();
        }
        $category->delete();

        session()->flash('success' , 'Category deleted successfully .');

        return redirect(route('categories.index'));
    }
}
