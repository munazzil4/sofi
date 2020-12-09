@extends('permissions.layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Permission </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
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


    <form action="{{ route('permissions.update', $permission->id ) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $permission->name  }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Display Name:</strong>
                    <input type="text" class="form-control" value="{{ $permission->display_name }}" name="display_name" placeholder="address">
                </div>
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" value="{{ $permission->description }}" class="form-control" name="description" placeholder="phone">
                </div>
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Module:</strong>
                    <input type="text" value="{{ $permission->module }}" class="form-control" name="module" placeholder="phone">
                </div>
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>User Status:</strong>
						<select name="status" class="form-control">							
						 <option value="1" {{ ($permission->status == 1) ? 'selected':''}}>Active</option>
						 <option value="0" {{ ($permission->status == 0) ? 'selected':''}}>Deactive</option>
						</select>
					</div>
				</div>			
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>


@endsection