@extends('layouts.particles')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="py-4" style="margin-top: 70px">
                <div align="center">
                    <img class="img-thumbnail" src="{{asset('img/qrcode.png')}}" style="width: 150px">
                    <h1 class="mt-3 text-white"> Attendance Monitoring System</h1>
                    <h5 class="text-warning"> using QR Code vr 1.0</h5>
                    <a href="{{route('user.login')}}" class="btn btn-primary mt-4 mr-1 border-white">
                        <i class="fa fw fa-users"></i> Scan Now
                    </a>
                    <a id="adminBtn" href="#" class="btn btn-dark mt-4 border-white">
                        <i class="fa fw fa-lock"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for delete user-->
<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-circle"></i> Admin Sign-In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body">
                <div class="container">
                    <div id="errors"></div>

                    <div id="loader" class="text-center" style="display: none; margin: 70px;">
                        <div class="spinner-border" style="width: 4rem; height: 4rem; color: #00b0ff" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="my-2">Please wait...</p>
                    </div>

                    <form id="adminForm">
                        <div class="form-group mb-3">
                            {{-- <h4>Username:</h4> --}}
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            {{-- <h4>Password:</h4> --}}
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        </div>
                         <div class="form-group">
                            <button class="btn btn-dark btn-block"><i class="fa fa-lock"></i> Sign-in</button>
                        </div>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function(){

    let date = new Date();
    let localeDate = date.toDateString();
    $('#displayDate').html('<i class="fa fa-calendar"></i> ' + localeDate);
    
    setInterval(displayTime, 500);

    function displayTime(){
        let time = new Date();
        let hrs = time.getHours();
        let min = time.getMinutes();
        let sec = time.getSeconds();
        let en = 'AM';
           
        if(hrs > 12){
            hrs = hrs - 12;
        }

        if(hrs < 12){
            en = 'PM';
        }

        if (hrs == 0){
            hrs = 12;
        }

        if(hrs < 10){
            hrs = '0' + hrs;
        }

        if(min < 10){
            min = '0' + min;
        }
        if(sec < 10){
            sec = '0'+ sec;
        }

        $('#displayTime').html('<i class="fa fa-clock"></i> '+ hrs + ':' + min + ':' + sec + ' ' +en);
    }


    $('#adminBtn').on('click', function(){
        $('#adminModal').modal('show');

        $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        $('#adminForm').on('submit', function(e){
            e.preventDefault();

            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                url: '{{ route('login.post')}}',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                beforeSend: function(){
                    $('#adminForm').hide();
                    $('#loader').show();
                },
                success: function(data){
                    let html = '';

                    if(data.errors){
                        html = '<div class="alert alert-danger">';
                        for(let count=0; count < data.errors.length; count++ ){
                            html += data.errors[count] + '</br>';
                        }
                        html += '</div>';

                        $('#loader').hide();
                        $('#adminForm').show();
                    }

                    if(data.status){
                        html = '<div class="alert alert-danger"> ' + data.status + '</div>';
                        $('#username').val('');
                        $('#password').val('');

                        $('#loader').hide();
                        $('#adminForm').show();
                    } 

                    if(data.redirect){

                        window.location = data.redirect;
                    }

                    $('#errors').html(html);
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });

});
</script>
@endsection