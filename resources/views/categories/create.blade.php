@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($category) ? 'Edit Category' : 'Create Category'}}</div>
        <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
             {{ implode('', $errors->all(':message')) }}

        </div>

        @endif
        <form class="" method="post" action="{{isset($category)? Route('categories.update',$category->id):Route('categories.store')}}">
        @csrf
        @if(isset($category))
        @method('put')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{isset($category)? $category->name : ''}}">
        </div>
        <button type="submit" class="btn btn-success">Create</button>

        </form>

                    
        </div>
    </div>
@endsection