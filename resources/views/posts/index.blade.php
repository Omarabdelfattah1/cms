@extends('layouts.app')

@section('content')



    <div class="card card-default">

        <div class="card-header ">
        <h4>Posts<a href="{{ Route('posts.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a></h4>
        </div>

        <div class="card-body">
            @auth
                @if($posts->count()>0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                            	<td>
                            		<img src="{{asset('storage/'.$post->image)}}" width="50px" height="50" >
                            	</td>
                                <td>
                                    {{$post->title}}
                                </td>
                                <td class="">


				                	<form method="POST" action="{{Route('posts.destroy' , $post->id)}}" >
					                    @csrf
					                    @method('DELETE')
	                                    <button type="submit" class="btn btn-danger "> {{!$post->trashed()?'Trash':'Delete'}}
	                                    </button>
	                                </form>
	                                </td>
	                                @if(!$post->trashed())
	                                <td>
	                                	<a href="{{Route('posts.edit',$post->id)}}"  class="btn btn-info "> Edit</a>
	                                </td>
	                                @else
	                                <td>
	                                	<form method="POST" action="{{Route('restore-posts.index' , $post->id)}}" >
					                    @csrf
					                    @method('put')
	                                    <button type="submit" class="btn btn-info "> Restore
	                                    </button>
	                                </form>
	                                </td>

	                                @endif
	                            
                            
                            </tr>
                        @endforeach
                     
                    </tbody>
                </table>
                @else
                <h1>No posts yet ...</h1>
               
                @endif  
            @else
                @if(isset($posts))
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    {{$post->name}}
                                </td>
                                <td class="">
                                </td>
                            
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
                @endif
            @endauth 
                              
        </div>
    </div>

@endsection