@extends('layouts.app')
     
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6" align="center">
            <img class="img-thumbnail" src="{{asset('img/qrcode.png')}}" style="width: 150px">

            <h1 class="display-3 mt-3 text-info"> Login System</h1>
            <h5 class="text-secondary"> using <span class="text-white">QR Code</span></h5>
            <a href="{{route('user.login')}}" class="btn btn-info mt-4 mr-1">
                <i class="fa fw fa-users"></i> Employees
            </a> 
            <a href="{{route('login')}}" class="btn btn-outline-light mt-4">
                <i class="fa fw fa-lock"></i> Admin
            </a>
        </div> 
    </div>
</div>
   
@endsection