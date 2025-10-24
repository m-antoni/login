@extends('layouts.app')

@section('content')

<div class="container">
	<div id="errors"></div>

	<div class="card border-left-primary">
		<div class="card-header">
			<div class="row">
				<div class="ml-1">
					<h3 class="display-4"><i class="fa fa-user-circle"></i> General Information</h3>
				</div>
				<div class="ml-auto mr-md-1">
					<a class="btn btn-secondary btn-circle" href="{{route('register.index')}}"><i class="fa fa-reply"></i></a>
					<a class="btn btn-primary btn-circle" href="{{route('register.edit', $register->id)}}"><i class="fa fa-edit"></i></a>
					<button type="button" class="deleteBtn btn btn-danger btn-circle">
						<i class="fa fa-times"></i> 
					</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="{{asset('storage/' . $register->photo)}}" class="image img-thumbnail border-secondary mb-2">

					<div class="text-center imageLoader" style="display: none; margin: 70px 0 70px 0;">
			            <div class="spinner-border" style="width: 3rem; height: 3rem; color: #00b0ff" role="status">
			              <span class="sr-only">Loading...</span>
			            </div>
			            <p class="my-2">Loading...</p>
			        </div>
			       
					<form id="uploadForm" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="id" value="{{$register->id}}">
								<input id="photo" name="photo" type="file" class="form-control">	
							</div>
							<div class="col-md-12 pt-1">
								<button type="submit" class="btn btn-primary btn-sm btn-block">
									<i class="fa fa-upload"></i> Upload Image
								</button>
							</div>
						</div>
					</form>
				
					<form id="deleteImageForm">
						<button type="submit" class="btn btn-sm btn-danger btn-block">
							<i class="fa fw fa-image"></i> Remove Image
						</button>	
					</form>
					
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

		        <div id="output" class="text-center" style="display: none; margin: 10px;">
		        	<i class="fa fa-check-circle fa-4x text-success"></i><br>
		        	<div class="my-2"><b>Deleted Successfully.</b></div>
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

		if($('.image').attr('src') == '{{Request::root()}}/storage/photos/default.jpg'){
			$('#uploadForm').show();
			$('#deleteImageForm').hide();
		}else{
			$('#deleteImageForm').show();
			$('#uploadForm').hide();
		}

		$('.deleteBtn').on('click', function(){
			$('#deleteModal').modal('show');
			let id = $('#userID').val();

			$('#deleteShow').on('submit', function(e){
				e.preventDefault();

				$.ajax({
					type: 'DELETE',
					url: "{{ route('register.delete', $register->id) }}",
					data: {id: id},
					dataType: 'json',
					beforeSend: function(){
						$('.loader').show();
						$('#deleteShow').hide();
					}
				})
				.done(function(){
					$('.loader').hide();
					$('h4').hide();
					$('#output').modal('show');

		            setInterval(function(){
		            	window.location = "{{route('register.index')}}";
		            }, 1000);
				})
				.fail(function(error){
					console.log('Error ' + error);
				})
			});
		});

		// Preview selected image before uploading
		$('#photo').on('change', function(event) {
			const file = event.target.files[0];
			if (file) {
				const reader = new FileReader();

				reader.onload = function(e) {
					$('.image').attr('src', e.target.result).show(); // preview image
					$('.imageLoader').hide();
				};

				reader.readAsDataURL(file); // convert file to base64 for preview
			}
		});

		// Upload image
		$('#uploadForm').on('submit', function(e){
			e.preventDefault();

			$.ajax({
				type: 'POST',
				url: "{{ route('upload.photo') }}",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				dataType: 'json',
				beforeSend: function(){
					$('.image').hide();
					$('.imageLoader').show();
					$('#photo').val('');
				}
			}).done(function(data){

				if(data.errors){

					let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';

					for(let count=0; count < data.errors.length; count++){
						html += data.errors[count] + '</br>';
					}
					
					 html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

					$('#errors').html(html);
					$('#photo').val('');
					$('.imageLoader').hide();
					$('.image').show();

				}else{
					$('#errors').html('');
					$('.imageLoader').hide();
					$('.image').attr('src', '{{Request::root()}}/storage/' + data.path);
					$('.image').show();
					$('#uploadForm').hide();
					$('#deleteImageForm').show();

					$('#photo').val(''); //clear
				}

			}).fail(function(data){
				console.log('Error ' + data);
			})
		})

		$('#deleteImageForm').on('submit', function(e){
			e.preventDefault();

			$.ajax({
				url: '{{ route("upload.delete", ["register" => $register->id]) }}',
				type: 'DELETE',
				beforeSend: function(){
					$('.image').hide();
					$('.imageLoader').show();
				}
			})
			.done(function(data) {
				$('.imageLoader').hide();
				$('.image').attr('src', '{{Request::root()}}/storage/' + data.path);
				$('.image').show();
				$('#uploadForm').show();
				$('#deleteImageForm').hide();

			})
			.fail(function(data) {
				console.log('Error ' + data);
			})
			
		});

	});
</script>
@endsection