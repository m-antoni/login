@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-2">  
            <h1 align="right" class="display-4"><i class=" fa fa-calendar"></i> {{$time}}</h1>
            <hr>     
        </div>
        <div class="col-md-4">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h1 class="display-4 text-warning">Users</h1> 
                    <h2><i class="fa fa-users"></i> {{$register}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-dark text-white">
                    <h1 class="display-4 text-warning">Logs</h1> 
                    <h2><i class="fa fa-clock-o"></i> {{$logs}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body bg-dark text-white">
                    <h1 class="display-4 text-warning">Active</h1> 
                    <h2><i class="fa fa-user"></i> {{$active}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
