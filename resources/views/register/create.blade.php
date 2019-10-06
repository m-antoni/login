@extends('layouts.app')

@section('content')

<div class="container">
	<h4>Add New</h4>
	<div class="card border-left-primary">
		<div class="card-body">
		  	<div id="errors"></div>

			<div id="output" align="center" style="display:none; margin: 50px;">
	            <h2 class="text-success"><i class="fa fa-check-circle fa-5x"></i> <br>
	            	<b>Registration Complete.</b>
	            </h2>
	            <h4>Please wait...</h4>
	        </div>

		  	<div class="text-center loader" style="display: none; margin: 70px;">
	            <div class="spinner-border" style="width: 8rem; height: 8rem; color: #00b0ff" role="status">
	              <span class="sr-only">Loading...</span>
	            </div>
	            <p class="my-2">Please wait...</p>
	        </div>

			<form id="addForm">
				@include('partials.form')
			</form>
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

    $('#addForm').on('submit', function(e){
    	e.preventDefault();

    	let first = $('#first').val();
    	let last = $('#last').val();
    	let middle = $('#middle').val();
    	let gender = $('#gender').val();
    	let age = $('#age').val();
    	let birthday = $('#birthday').val();
    	let contact = $('#contact').val();
    	let email = $('#email').val();
    	let address = $('#address').val();
    	let department = $('#department').val();
    	let date_hired = $('#date_hired').val();
    	let id_number = $('#id_number').val();
    	let user_type = $('#user_type').val();

    	$.ajax({
    		type: 'POST',
    		url: '{{route('register.store')}}',
    		data: {
    			first: first,
    			last: last,
    			middle: middle,
    			gender: gender,
    			age: age,
    			birthday: birthday,
    			contact: contact,
    			email: email,
    			address: address,
    			department: department,
    			date_hired: date_hired,
    			id_number: id_number,
    			user_type: user_type
    		},
    		dataType: 'json',
    		beforeSend: function(){
    			$('#addForm').hide();
    			$('.loader').show();
    		},
    		success: function(data){

    			if(data.errors){
    				html = '<div class="alert alert-danger">';
                    for(let count=0; count < data.errors.length; count++ ){
                        html += data.errors[count] + '</br>';
                    }
                    html += '</div>';

                    $('.loader').hide();
                    $('#addForm').show();
    			}
    			
    			if(data.success){
    				// success
    				$('#errors').hide();
    				$('.loader').hide();
    				$('#output').show();

    				setInterval(function(){
    					window.location = '{{route('register.download')}}';
    				}, 2000)
    			}

    			$('#errors').html(html);
    		},
    		error: function(data){
    			console.log('Error: ' + data);
    		}
    	});
    });
});
</script>
@endsection


