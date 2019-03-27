@extends('layouts.app')

@section('content')
	<ol class="breadcrumb">
	  <li class="breadcrumb-item">
	    	<a href="{{route('register.index')}}">users</a>
	  </li>
	  <li class="breadcrumb-item">
	    	<a href="{{route('register.create')}}">create</a>
	  </li>
	  <li class="breadcrumb-item active">
	  		show
	  </li>
	</ol>

	{{--  alert messages --}}
	@include('partials.message')

	<h3 class="display-4"><i class="fa fa-user-circle"></i> General Information</h3 class="display-5">
	<div class="card">
			<div class="card-header">
				<div class="row">
						<div class="ml-1">
								<a class="btn btn-default text-primary" href="{{route('register.edit', $register->id)}}"><i class="fa fa-edit"></i> edit</a>
						</div>
						<div class="ml-auto mr-md-1">
							<form action="{{route('register.delete', $register->id)}}" method="POST">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-default text-danger"><i class="fa fa-times"></i> delete</button>
							</form>
						</div>
				</div>
				</div>
			<div class="card-body">
					<div class="row">
							<div class="col-md-3">
									<img src="{{asset('img/default.jpg')}}" class="img-thumbnail border-secondary mb-2">
									<a class="btn btn-sm btn-info btn-block" href="{{route('upload', $register->id)}}"><i class="fa fw fa-edit"></i> EDIT PHOTO</a>
							</div>
							<div class="col-md-4">
									<p><strong class="text-secondary">Name: </strong>{{$register->last . ', ' . $register->first . ' ' . $register->middle}}</p>
									<p><strong class="text-secondary">Gender: </strong>{{$register->gender}}</p>
									<p><strong class="text-secondary">Birthday: </strong>{{$register->birthday}}</p>
									<p><strong class="text-secondary">Address: </strong>{{$register->address}}</p>
									<p><strong class="text-secondary">Contact: </strong>{{$register->contact}}</p>
									<p><strong class="text-secondary">Email: </strong>{{$register->email}}</p>
									<p><strong class="text-secondary">Department: </strong>{{$register->department}}</p>
							</div>
							<div class="col-md-4">
									<p><strong class="text-secondary">Date Hired: </strong>{{$register->date_hired}}</p>
									<p><strong class="text-secondary">User Type: </strong>{{$register->user_type}}</p>
									<p><strong class="text-secondary">ID Number: </strong>{{$register->id_number}}</p>
									<p><strong class="text-secondary">Encrypted Password: </strong>{{$register->password}}</p>
							</div>
					</div>
			</div>
	</div>
@endsection 