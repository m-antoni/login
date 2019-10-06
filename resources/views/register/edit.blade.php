@extends('layouts.app')

@section('content')

<div class="container">
  <div id="errors"></div>
  <div class="card border-left-primary">
          <div class="card-header">
            <div class="row">
                <div class="ml-1">
                  <h3 class="display-4"><i class="fa fa-edit"></i> Edit Information</h3>
                </div>
                <div class="ml-auto mr-md-1">
                  <a class="btn btn-secondary btn-circle" href="{{route('register.index')}}"><i class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
      	<div class="card-body">

            <div id="output" align="center" style="display:none; margin: 50px;">
              <h3 class="text-success"><i class="fa fa-check-circle fa-4x"></i> <br>
                <b>Update Complete.</b>
              </h3>
              <h4>Please wait...</h4>
            </div>

            <div class="text-center loader" style="display: none; margin: 70px;">
                <div class="spinner-border" style="width: 8rem; height: 8rem; color: #00b0ff" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
                <p class="my-2">Please wait...</p>
            </div>

      			<form id="editForm">
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

    $('#editForm').on('submit', function(e){
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
            url: '{{ route('register.update', $register->id)}}',
            type: 'PATCH',
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
            datType: 'json',
            beforeSend: function(){
                $('#editForm').hide();
                $('.loader').show();
            }
        })
        .done(function(data){
            $('.loader').hide();  
            $('#editForm').show();


            if(data.errors){
                html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                for(let count=0; count < data.errors.length; count++ ){
                    html += data.errors[count] + '</br>';
                }
                html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

                $('#errors').html(html);
                $('.loader').hide();
                $('#editForm').show();
            }

            if(data.success){
                // success
                $('#errors').hide();
                $('.loader').hide();
                $('#editForm').hide();
                $('#output').show();

                setInterval(function(){
                    window.location = '{{route('register.show', $register->id )}}';
                }, 1000)
            }

        })  
        .fail(function(error){
            console.log('Error ' + error);
        })
    });



});
</script>
@endsection