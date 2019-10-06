@extends('layouts.app')

@section('content')

<div class="container">

	<h4>{{ count($users) <= 0 ? 'There is No Data....' : 'Users'}}</h4>

	<a href="{{ route('register.create') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i> Add New</a>

	<table id="users" class="table table-hover table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>NO</th>
				<th>First</th>
				<th>Last</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Department</th>
				<th width="90px">Action</th>
			</tr>
		</thead>
	</table>
</div>

<!-- Modal for delete user-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
		     <div class="modal-header">
		        {{-- <h5 class="modal-title text-danger"></h5> --}}
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

		      			<form id="deleteForm">
							@method('DELETE')
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
<script>
	$(document).ready(function(){
	   	$.ajaxSetup({
	        headers:{
	          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
	        }
	    });

		$('#users').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{ route('register.index') }}',
			columns: [
				{data: 'id', name: 'id'},
				{data: 'id_number', name: 'id'},
				{data: 'first', name: 'first'},
				{data: 'last', name: 'last'},
				{data: 'contact', name: 'contact'},
				{data: 'email', name: 'email'},
				{data: 'department', name: 'department', ordering: false, searching: false},
				{data: 'action', name: 'action', ordering: false, searching: false},
			]
		});

		$('body').on('click', '.delete', function(){
			let id = $(this).data('id');
			$('#deleteID').val(id);
			$('#deleteModal').modal('show');

			$('#deleteForm').on('submit', function(e){
				e.preventDefault();

				$.ajax({
					type: 'DELETE',
					url: "register" + "/" + id,
					data: {id: id},
					dataType: 'json',
					beforeSend: function(){
						$('.loader').show();
						$('#deleteForm').hide();
					},
				})
				.done(function(data){
					if(data.success){
						$('#deleteModal').modal('hide');
						iziToast.show({
			                title: 'Success',
			                theme: 'dark',
			                icon: 'ico-success',
			                progressBarColor: '#1cc88a',
			                position: 'bottomRight',
			                transitionIn: 'bounceInLeft',
			                transitionOut: 'flipOutX',
			                message: '<b>' + data.success + '</b>',
			            });

			            $('.loader').hide();
						$('#deleteForm').show();
						$('#users').DataTable().ajax.reload();
					// window.location.reload();
					}
				})
				.fail(function(data){
					console.log('Error' + data)
				})
		
			})
		});

	});

	
</script>
@endsection
