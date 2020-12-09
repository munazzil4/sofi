@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull">
                <center><h2>User Details</h2></center>
            </div>
			<br><br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New user</a>
            </div>
			<div class="pull-left">
                <a class="btn btn-primary" href="{{ url('') }}"> GO TO HOME</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<br><br>
<div class="container">
	<div table="table table-bordered">
		<div class="row">
    <table class="table ">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
			<th>User Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $key => $user)
        <tr bgcolor="{{ ( $user->user_status == 0) ? 'red':''}}">
            <td>{{ $key+1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
			<td>{{ $roles[$user->user_role] }}</td>
            <td>
			
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    {{--<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>--}}
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
   
                    <button type="submit" class="btn btn-danger" onclick= "return confirm('Are You Sure Want to Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</div>
</div>
    {!! $users->links() !!}
@endsection