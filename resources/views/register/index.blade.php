@extends('layouts.app')

@section('content')

<div class="container">
	<h4>{{ count($users) <= 0 ? 'There is No Data....' : 'Users'}}</h4>

	{{--  alert messages --}}
	@include('partials.message')

	<table id="users" class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>ID NUMBER</th>
				<th>Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Department</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>

<!-- Modal for delete user-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		     <div class="modal-header">
		        <h5 class="modal-title text-danger"><i class="fa fw fa-warning"></i> Warning</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		     </div>
		     <div class="modal-body">
		      	<div class="container">
		  			<h4 align="center">Do you want to delete this user?</h4>
		  			<div class="row justify-content-center mb-3">
		      			<form action="#" method="POST">
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

@section('script')
<script>
	$(document).ready(function(){

		$('h4').on('click', function(e){
			e.preventDefault();

			$('#deleteModal').modal('show');
			console.log(123123);
		});

		$('#users').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('get.users') !!}',
			columns: [
				{data: 'id', name: 'id'},
				{data: 'id_number', name: 'id'},
				{data: 'name', name: 'name'},
				{data: 'contact', name: 'contact'},
				{data: 'email', name: 'email'},
				{data: 'department', name: 'department'},
				{data: 'action', name: 'action'},
			]
		});

	});
</script>
@endsection
