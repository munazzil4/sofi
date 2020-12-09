@extends('users.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('users.update', $user->id ) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control"  name="email" value="{{$user->email}}" placeholder="email">
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" class="form-control" name="password"  placeholder="Password">
                </div>
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password" class="form-control" name="password_confirmation"  placeholder="Password">
                </div>
            </div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>User Roles:</strong>
						<select name="user_role" class="form-control">
					   @foreach($roles as $key => $role)
						 <option value="{{$key}}" {{ ($key == $user->user_role) ? 'selected':''}}>{{$role}}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>User Status:</strong>
						<select name="user_status" class="form-control">					   
						 <option value="1" {{ ($user->user_status == 1) ? 'selected':''}} >Active</option>
						 <option value="0" {{ ($user->user_status == 0) ? 'selected':''}} >Deactive</option>						
						</select>
					</div>
				</div>			
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection