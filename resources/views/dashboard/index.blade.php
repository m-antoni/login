@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <h1 class="display-4 text-warning">Active</h1> 
                            <h2><i class="fa fa-check"></i> {{$active}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body bg-dark text-white">
                            <h1 class="display-4 text-warning">Inactive</h1> 
                            <h2><i class="fa fa-times"></i> {{$inactive}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body bg-dark text-white">
                            <h1 class="display-4 text-warning">Late Users</h1> 
                            <h2><i class="fa fa-sign-in"></i> <a class="text-white" href="{{route('dashboard.late')}}">{{$lateToday}}</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body bg-dark text-white">
                            <h1 class="display-4 text-warning">Under Time Users</h1> 
                            <h2><i class="fa fa-arrow-circle-o-down"></i> <a class="text-white" href="{{route('dashboard.under')}}">{{$underTimeToday}}</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-12 mb-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h3 align="center" class=""><i class=" fa fa-clock-o"></i> {{$time}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-dark text-white"><h1 class="display-4">Total Users</h1></div>
                    <div class="card-body bg-secondary text-white">
                        <h2><i class="fa fa-users"></i> {{$register}}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white"><h1 class="display-4">Total Logs</h1> </div>
                    <div class="card-body bg-secondary text-white">
                        <h2><i class="fa fa-list"></i> {{$logs}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection