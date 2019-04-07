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
								<a class="btn btn-default text-primary" href="{{route('register.edit', $register->id)}}"><i class="fa fa-edit"></i> Edit</a>
						</div>
						<div class="ml-auto mr-md-1">
							{{-- <form action="{{route('register.delete', $register->id)}}" method="POST">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-default text-danger"><i class="fa fa-times"></i> delete</button>
							</form> --}}
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-default text-danger" data-toggle="modal" data-target="#deleteModal">
								<i class="fa fw fa-times"></i>
							</button>
						</div>
				</div>
				</div>
			<div class="card-body">
					<div class="row">
							<div class="col-md-3">
									<img src="{{asset('/storage/photos/' . $register->photo)}}" class="img-thumbnail border-secondary mb-2">
											@if($register->photo == 'default.jpg')
												{{-- 	<a class="btn btn-sm btn-info btn-block" href="{{route('upload', $register->id)}}"><i class="fa fw fa-edit"></i> Edit Image</a> --}}
												<form action="{{ route('upload.update',$register->id)}}" method="POST" enctype="multipart/form-data">
													@method('PATCH')
													@csrf
													<div class="row">
															<div class="col-md-12">
																	<input type="file" name="photo">	
															</div>
															<div class="col-md-12 pt-1">
																	@if ($errors->has('photo'))
													            <span class="text-danger" role="alert">
													                {{ $errors->first('photo') }}
													            </span>
									        				@endif
																	<button type="submit" class="btn btn-info btn-sm">
																		<i class="fa fw fa-image"></i> Upload Image
																	</button>
															</div>
													</div>
												</form>
											@else
												<form action="{{route('upload.delete', $register->id)}}" method="POST">
														@method('PATCH')
														@csrf
														<button type="submit" class="btn btn-sm btn-danger btn-block"><i class="fa fw fa-image"></i> Delete Image</button>	
												</form>
											@endif
							</div>
							<div class="col-md-4">
									<p><strong class="text-secondary">Name: </strong>{{$register->last . ', ' . $register->first . ' ' . $register->middle}}</p>
									<p><strong class="text-secondary">Gender: </strong>{{$register->gender}}</p>
									<p><strong class="text-secondary">Age: </strong>{{$register->age}}</p>
									<p><strong class="text-secondary">Birthday: </strong>{{date('M j, Y', strtotime($register->birthday))}}</p>
									<p><strong class="text-secondary">Address: </strong>{{$register->address}}</p>
									<p><strong class="text-secondary">Contact: </strong>{{$register->contact}}</p>
							</div>
							<div class="col-md-4">
									<p><strong class="text-secondary">Email: </strong>{{$register->email}}</p>
									<p><strong class="text-secondary">Date Hired: </strong>{{date('M j, Y', strtotime($register->date_hired))}}</p>
									<p><strong class="text-secondary">Department: </strong>{{$register->department}}</p>
									<p><strong class="text-secondary">User Type: </strong>{{$register->user_type}}</p>
									<p><strong class="text-secondary">ID Number: </strong>{{$register->id_number}}</p>
							</div>
					</div>
			</div>
	</div>

	<!-- Modal for delete user-->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-dark text-white">
	        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fw fa-user-circle"></i> User Delete</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="container">
	      			<h1 class="display-4 mb-4">Do you want to delete this user?</h1>
	      			<div class="row justify-content-center">
		      			<form action="{{route('register.delete', $register->id)}}" method="POST">
										@method('DELETE')
										@csrf
										<button type="submit" class="btn btn-outline-info">
											<i class="fa fa-check"></i> Confirm
										</button>
								</form>
	      			</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>

@endsection 