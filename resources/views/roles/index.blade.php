@extends('roles.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull">
                <center><h2>User Group Details</h2><center>
            </div>
			<br><br>
            {{--<div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create User</a>
            </div>--}}
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
			<table class="table table-striped">
				<tr>
					 <th>No</th>
					 <th>Type</th>
					 <th>Permission</th>
					<th width="280px">Action</th>
				</tr>
				@foreach ($roles as $key => $role)
				<tr>
					<td>{{ $key }}</td>
					<td>{{ $role }}</td>
					<td ><a class="btn btn-success"  href="{{ url('role/'.$key.'/permissions') }}">Permissions</a></td>
					<td>
						<form action="{{ route('roles.destroy',$key) }}" method="POST" >
							
							<a class="btn btn-primary" href="{{ route('roles.edit',$key) }}">Edit</a>
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
    
@endsection