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
					<a class="btn btn-secondary btn-circle btn-sm" href="{{route('register.index')}}"><i class="fa fa-arrow-left"></i></a>
					<a class="btn btn-primary btn-circle btn-sm" href="{{route('register.edit', $register->id)}}"><i class="fa fa-edit"></i></a>
					<button type="button" class="deleteBtn btn btn-danger btn-circle btn-sm">
						<i class="fa fa-times"></i> 
					</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="" class="image img-thumbnail border-secondary mb-2">

					<div class="text-center imageLoader" style="display: none; margin: 20px;">
			            <div class="spinner-border" style="width: 3rem; height: 3rem; color: #00b0ff" role="status">
			              <span class="sr-only">Loading...</span>
			            </div>
			            <p class="my-2">Please wait...</p>
			        </div>

					@if($register->photo == 'default.jpg')
						<form id="uploadImageForm" action="{{ route('upload.update',$register->id)}}" method="POST" enctype="multipart/form-data">
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
									<button type="submit" class="btn btn-primary btn-sm btn-block">
										<i class="fa fa-upload"></i> Upload Image
									</button>
								</div>
							</div>
						</form>
					@else
						<form action="{{route('upload.delete', $register->id)}}" method="POST">
							@method('PATCH')
							@csrf
							<button type="submit" class="btn btn-sm btn-danger btn-block">
								<i class="fa fw fa-image"></i> Delete Image
							</button>	
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

  				<div class="text-center loader" style="display: none; margin: 20px;">
		            <div class="spinner-border" style="width: 3rem; height: 3rem; color: #00b0ff" role="status">
		              <span class="sr-only">Loading...</span>
		            </div>
		            <p class="my-2">Please wait...</p>
		        </div>

		        <div id="output" class="text-center text-success" style="display: none; margin: 20px;">
		        	<i class="fa fa-check-circle fa-3x"></i>
		        	<div>Deleted Successfully!</div>
		        </div>

      			<form id="deleteShow">
					<input id="userID" type="hidden" value="{{$register->id}}">
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

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
	        headers:{
	          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	        }
	    });

		if($('.img-thumbnail').attr("href", null)){
			$('.img-thumbnail').attr("href", "{{ asset('/storage/photos/default.jpg' ) }}")

		}else{
			$('.img-thumbnail').attr("href", "{{ asset('/storage/photos/' . $register->photo) }}")
		}


		$('.deleteBtn').on('click', function(){
			$('#deleteModal').modal('show');

			let id = $('#userID').val();

			$('#deleteShow').on('submit', function(e){
				e.preventDefault();

				$.ajax({
					type: 'DELETE',
					url: "{{ url()->full() }}",
					data: {id: id},
					dataType: 'json',
					beforeSend: function(){
						$('.loader').show();
						$('#deleteShow').hide();
					},
					success: function(data){
						$('.loader').hide();
						$('#output').modal('show');

			            setInterval(function(){
			            	window.location = "{{route('register.index')}}";
			            }, 1000);
					},
					error: function(data){
						console.log('Error ' + data);
					}
				})
			});


			$('#uploadImageForm').on('submit', function(e){
				e.preventDefault();

				$.ajax({
					type: 'PATCH',
					url: "register/" + '{{$register->id}}' + "/update",
					data: new FormData(this),
					cache: false,
					contentType: false,
					processData:false,
					dataType: 'json',
					beforeSend: function(){
						$('.image').hide();
						$('.imageLoader').show();
					},
					success: function(data){
						$('.imageLoader').hide();
					}
				});
			})
			
		});
	});
</script>
@endsection