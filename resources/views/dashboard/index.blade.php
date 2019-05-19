@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Employees</h1> 
                            <h2><i class="fa fa-users"></i> 
                                <a class="text-white" href="{{route('dashboard.employees')}}">{{$employees}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Interns</h1> 
                            <h2><i class="fa fa-street-view"></i>
                                <a class="text-white" href="{{route('dashboard.interns')}}">{{$interns}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Active</h1> 
                            <h2><i class="fa fa-child"></i> 
                                <a class="text-white" href="{{route('dashboard.active')}}">{{$active}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Inactive</h1> 
                            <h2><i class="fa fa-user-times"></i>
                                <a class="text-white" href="{{route('dashboard.inactive')}}">{{$inactive}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Late</h1> 
                            <h2><i class="fa fa-times"></i> 
                                <a class="text-white" href="{{route('dashboard.late')}}">{{$lateToday}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Under Time</h1> 
                            <h2><i class="fa fa-calendar-times-o"></i> 
                                <a class="text-white" href="{{route('dashboard.under')}}">{{$underTimeToday}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-12 mb-3">
                <div class="card text-info">
                    <div class="card-header"><h5 align="center"><i class="fa fa-calendar"></i> {{$time}}</h5></div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card border-secondary">
                    <div class="card-header"><h5 class="display-4"><i class="fa fa-database"></i> Total Details</h5></div>
                    <div class="card-body bg-dark text-white" style="line-height: 1rem;">
                        <p class="lead"><i class="fa fa-users"></i> Users: {{$register}}</p>
                        <p class="lead"><i class="fa fa-edit"></i> Logs: {{$logs}}</p>
                        <p class="lead"><i class="fa fa-thumbs-down"></i> Lates: {{$lates}} hrs</p>
                        <p class="lead"><i class="fa fa-calendar-times-o"></i> Under time: {{$under}} hrs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection