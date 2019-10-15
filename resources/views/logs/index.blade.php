@extends('layouts.app')

@section('content')

<div class="container">
	<h4>{{count($logs) <= 0 ? 'There is No Data....' : 'Logs'}}</h4>

	@if(count($logs) > 0)
		<table id="logsTable" class="table table-hover table-responsive-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Log In</th>
					<th>Log Out</th>
					<th>Late (hr)</th>
					<th>Under (hr)</th>
					<th>Status</th>
					<th width="50px">Action</th>
				</tr>
			</thead>
		</table>
	@endif
</div>


<!-- Modal for delete user-->
<div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
		     <div class="modal-header">
		        {{-- <h5 class="modal-title text-danger"></h5> --}}
		        <button id="closeBtn" type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		     </div>
		     <div class="modal-body">
		      	<div class="container">
		  			<div class="row justify-content-center mb-3">

		  				<div class="text-center loader" style="display: none; margin: 20px;">
				            <div class="spinner-border" style="width: 3rem; height: 3rem; color: #00b0ff" role="status">
				              <span class="sr-only">Loading...</span>
				            </div>
				            <p class="my-2">Please wait...</p>
				        </div>

		      			<form id="deleteLogForm" class="text-center">
		      				<h4>Are you sure?</h4>
							<button type="submit" class="btn btn-primary my-3">
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

		// datatables
		$('#logsTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{{ route('logs.index') }}',
			columns: [
				{data: 'id', name: 'id'},
				{data: 'name', name: 'name', searching: false},
				{data: 'log_in', name: 'log in', searching: false},
				{data: 'log_out', name: 'log out', searching: false},
				{data: 'late', name: 'late', searching: false},
				{data: 'under', name: 'under', searching: false},
				{data: 'status', name: 'status', searching: false},
				{data: 'action', name: 'action', ordering: false, searching: false},
			]
		});

		// this will prevent from deleting multi rows
		$('#closeBtn').on('click', function(){
			$('#logsTable').DataTable().ajax.reload();
		});
		
		$('body').on('click', '.deleteBtn',function(){
			$('#logModal').modal('show');
			let id = $(this).data('id');

			$('#deleteLogForm').on('submit', function(e){
				e.preventDefault();

				$.ajax({
					url: '{{ url()->current() }}/' + id,
					type: 'POST',
					dataType: 'json',
					data: {id: id, _method: 'DELETE'},
					beforeSend: function(){
						$('#deleteLogForm').hide();
						$('.loader').show();
					}
				})
				.done(function(data) {
					$('#logModal').modal('hide');
					// show izitoast
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
					$('#deleteLogForm').show();
					setInterval(function(){
						window.location.reload();
						// $('#logsTable').DataTable().ajax.reload();
					},2000);

				})
				.fail(function(error) {
					console.log("Error " + error);
				});
			})// submit
		});

	}); // document
</script>
@endsection