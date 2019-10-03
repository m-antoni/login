@extends('layouts.app')

@section('content')

<div class="container">
	<div class="card border-left-primary">
		<div class="card-header">
			<div class="row">
				<div class="ml-1">
					<h3 class="display-4"><i class="fa fa-user-circle"></i> General Information</h3>
				</div>
				<div class="ml-auto mr-md-1">
					<a class="btn btn-primary btn-circle" href="{{route('register.edit', $register->id)}}"><i class="fa fa-edit"></i></a>
					<button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal">
						<i class="fa fa-times"></i> 
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
											<i class="fa fa-upload`"></i> Upload
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
					<p><strong class="text-secondary">Name: </strong>{{$register->getFullNameAttribute()}}</p>
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
</div>

<!-- Modal for delete user-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container">
  			<h4 align="center">Are you sure?</h4>
  			<div class="row justify-content-center mb-3">
      			<form action="{{route('register.delete', $register->id)}}" method="POST">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn btn-primary mt-3">
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