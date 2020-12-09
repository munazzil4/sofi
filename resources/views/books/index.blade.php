@extends('books.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull">
                <center><h2>Book Details</h2><center>
            </div>
			<br><br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
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
    <table class="table table-striped">
        <tr>
             <th>No</th>
             <th>isbn</th>
             <th>Title</th>
			 <th>Price</th>
			 <th>Description</th>
			 <th>Image</th>
			 
            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td align="center">{{ ++$i }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->title }}</td>
			<td>{{ $book->price }}</td>
			<td>{{ $book->description }}</td>
			<td><img src="{{asset('images/'.$book->filename)}}" class="img-fluid" width="200" height="50" ></td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST" >
					{{-- <a class="btn btn-info" href="{{ route('books.show',$book->id) }}">Show</a> --}}
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>

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
    {!! $books->links() !!}

@endsection