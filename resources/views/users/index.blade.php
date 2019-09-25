@extends('layouts.app')

@section('content')


    <div class="card card-default">

        <div class="card-header ">
        <h4>Users</h4>
        </div>

        <div class="card-body">
            @auth
                @if($users->count()>0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>name</th>
                        <th>email</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                            	<td>
                                    <img src="{{ Gravatar::src($user->email) }}"  width="40px" hight="40px" style="border-radius: 50%;">
                            	</td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td class="">
                                    {{$user->email}}
                                </td>
                                <td class="">
                                    @if(!$user->isAdmin())
                                    <form method="post" action="{{route('users.make-admin',$user->id)}}">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        
                                    </form>
                                    @endif
                                </td>
	                            
                            
                            </tr>
                        @endforeach
                     
                    </tbody>
                </table>
                @else
                <h1>No users yet ...</h1>
               
                @endif  
            @else
                @if(isset($users))
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->name}}
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