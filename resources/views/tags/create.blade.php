@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($tag) ? 'Edit tag' : 'Create tag'}}</div>
        <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
             {{ implode('', $errors->all(':message')) }}

        </div>

        @endif
        <form class="" method="post" action="{{isset($tag)? Route('tags.update',$tag->id):Route('tags.store')}}">
        @csrf
        @if(isset($tag))
        @method('put')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{isset($tag)? $tag->name : ''}}">
        </div>
        <button type="submit" class="btn btn-success">Create</button>

        </form>

                    
        </div>
    </div>
@endsection