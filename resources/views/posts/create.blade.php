@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post'}}</div>
        <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
             {{ implode('', $errors->all(':message')) }}

        </div>

        @endif

        <form enctype="multipart/form-data" method="post" action="{{isset($post)? Route('posts.update',$post->id):Route('posts.store')}}">
        @csrf
        
        @if(isset($post))
        @method('put')
        @endif 
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{isset($post)? $post->title : ''}}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" cols="5" rows="5" id="description" name="description" >{{isset($post)? $post->description : ''}}</textarea>
                
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
                <trix-editor input="content"></trix-editor>
                
            </div>
            <div class="form-group">
                <label for="published_at">published at</label>
                <input type="" class="form-control" id="published_at" name="published_at" value="{{isset($post)?$post->published_at:''}}" >
                
            </div>
            @if(isset($post))
            <div class="form-group">
                <img src="/storage/{{$post->image}}" width="100%">
                
            </div>
            @endif
            <div class="form-group">

                <label for="image">Image</label>
                <input type="file" class="" id="image" name="image" >
                
            </div>
            <div class="form-group">

                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)

                        @if(isset($post))
                            @if($post->category_id==$category->id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            
                            @endif
                        
                        @else
                            <option value="{{$category->id}}" >{{$category->name}}</option>
                        @endif
                        
                    @endforeach
                </select>
                
            </div>
            @if($tags->count() >0)
                
                <div class="form-group">

                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control selector" multiple>
                    @foreach($tags as $tag)
                        @if(isset($post))
                            @if($post->hasTag($tag->id))
                                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                            @else
                                <option value="{{$tag->id}}" >{{$tag->name}}</option>
                                
                            @endif
                        
                        @else
                            <option value="{{$tag->id}}" >{{$tag->name}}</option>
                        @endif
                    @endforeach
                    </select>
                
                </div>
            @endif  

            <button type="submit" class="btn btn-success">{{isset($post)?'Update':'Create'}}</button>

        </form>

                    
        </div>
    </div>
@endsection
@section('links')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>

<script >
    flatpickr( '#published_at',{
        enableTime:true,
        enableSeconds:true
    });

    $(".selector").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
  @endsection