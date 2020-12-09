@extends('permissions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull">
                <center><h2>Permission Details</h2></center>
            </div>
			<br><br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New Permission</a>
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
            <th>Display Name</th>
			 <th>Description</th>
			 <th>Module</th> 
            <th width="280px">Action</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr bgcolor="{{$permission->status == 0 ? 'red':''}}" >
            <td >{{ ++$i }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->display_name }}</td>
			<td>{{ $permission->description }}</td>
			<td>{{ $permission->module }}</td>
            
            <td>			
                <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
                    {{--<a class="btn btn-info" href="{{ route('permissions.show',$permission->id) }}">Show</a>--}}
                    <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>

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