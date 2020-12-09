@extends('permissions.layout')

@section('content')

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
            <th>Display Name</th>			
        </tr>
		<form method="post" >
		@csrf
        @foreach ($permissions as $permission)
        <tr>
            <td><input type="checkbox" name="permission_ids[]" value="{{$permission->id}}" {{in_array($permission->id,$ids) ? 'checked':''}}></td>           
            <td>{{ $permission->display_name }}</td>      
        </tr>
        @endforeach
	
		<button type="submit" class="btn btn-primary">Submit</button>
		</form>
    </table>
</div>
</div>
</div>
    
@endsection