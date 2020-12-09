@extends('authors.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull">
                <center><h2>Author Details</h2></center>
            </div>
			<br><br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('authors.create') }}"> Create New Author</a>
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
            <th>Address</th>
			 <th>Phone</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($authors as $author)
        <tr bgcolor="{{$author->author_status == 0 ? 'red':''}}" >
            <td >{{ ++$i }}</td>
            <td>{{ $author->name }}</td>
            <td>{{ $author->address }}</td>
			<td>{{ $author->phone }}</td>
            <td>
			
                <form action="{{ route('authors.destroy',$author->id) }}" method="POST">
                    {{--<a class="btn btn-info" href="{{ route('authors.show',$author->id) }}">Show</a>--}}
                    <a class="btn btn-primary" href="{{ route('authors.edit',$author->id) }}">Edit</a>

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
    {!! $authors->links() !!}


@endsection