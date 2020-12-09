@extends('layouts.app')

@section('main')
<div class="container-fluid ">	
	<nav class="navbar navbar-expand-xl bg-primary navbar-dark  ">
		<div class="col-md-9 p-3">
		<ol class="navbar-nav">
		
			<li class=" nav-item">
				<div class="nav-link">
					<a class="btn btn-primary" href="{{ route('authors.index') }}"> View Authors</a>
				</div>	
			</li>	
				<br>
			<li class=" nav-item">
				<div class="nav-link">
					<a class="btn btn-primary" href="{{ route('books.index') }}"> View Books</a>
				</div>
			</li>
			<li class=" nav-item">
				<div class="nav-link">
					<a class="btn btn-primary" href="{{ route('users.index') }}"> View Users</a>
				</div>
			</li>
			<li class=" nav-item">
				<div class="nav-link">
					<a class="btn btn-primary" href="{{ route('permissions.index') }}"> View Permission</a>
				</div>
			</li>
			<li class=" nav-item">
				<div class="nav-link">
					<a class="btn btn-primary" href="{{ route('roles.index') }}"> View User Group</a>
				</div>
			</li>
		</div>
			
			<div class="col-md-3 p-3">
				<div class="nav-item dropdown">				
							<a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-primary"   data-toggle="dropdown" >
												{{ Auth::user()->name }}
							</a>	
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}"
										   onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" >
											@csrf
										</form>		
									</div>
					</div>
				</div>
		</ol>		
	</nav>
</div>
@if ($message = Session::get('error'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@endsection
