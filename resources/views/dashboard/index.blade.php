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
                            <h2><i class="fa fa-graduation-cap"></i>
                                <a class="text-white" href="{{route('dashboard.interns')}}">{{$interns}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Active</h1> 
                            <h2><i class="fa fa-user"></i> {{$active}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Inactive</h1> 
                            <h2><i class="fa fa-user-times"></i> {{$inactive}}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h1 class="display-4">Late</h1> 
                            <h2><i class="fa fa-thumbs-o-down"></i> 
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
            <div class="col-md-12 mb-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 align="center"><i class="fa fa-calendar"></i> {{$time}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white"><h5>Total Details</h5></div>
                    <div id="totalDetails" class="card-body">
                        <h6 class="display-4"><i class="fa fa-users"></i> Users: {{$register}}</h6>
                        <h6 class="display-4"><i class="fa fa-edit"></i> Logs: {{$logs}}</h6>
                        <h6 class="display-4"><i class="fa fa-thumbs-o-down"></i> Lates: {{$lates}} hrs</h6>
                        <h6 class="display-4"><i class="fa fa-calendar-times-o"></i> Under time: {{$under}} hrs</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection