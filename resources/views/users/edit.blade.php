@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My profile</div>

                <div class="card-body">
                    

                    <form method="post" action="{{route('users.update')}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea class="form-control" cols="5" rows="5" name="about">{{$user->about}}</textarea>
                        </div>
                        <button class="btn btn-success" type="submit">Update</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
