@extends('layouts.app')

@section('content')

    <div class="card card-default">

        <div class="card-header ">
        <h4>tags<a href="{{ Route('tags.create')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a></h4>
        </div>

        <div class="card-body">
            @auth
                @if($tags->count()>0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Posts</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($tags as $c)
                            <tr>
                                <td>
                                    {{$c->name}}
                                </td>
                                <td>
                                    {{$c->posts->count()}}
                                </td>
                                <td class="">
                                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModal" onclick="handleDelete({{ $c->id }})">Delete</button>
                                    <a href="{{Route('tags.edit',$c->id)}}"  class="btn btn-info ">Edit</a>
                                </td>
                            
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
                @else
                
                @endif
                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="" id="deleteTagForm">
                        @csrf
                        @method('delete')
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this Tag?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Save changes</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>                

                  
            @else
                @if(isset($tags))
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($tags as $c)
                            <tr>
                                <td>
                                    {{$c->name}}
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
@section('scripts')
<script type="text/javascript">
    function handleDelete(id) {
        console.log('deleting.' ,id)
        var form =document.getElementById('deleteTagForm')
        form.action='/tags/'+id
        $('#deleteModal').modal('show')
    }

</script>


@endsection