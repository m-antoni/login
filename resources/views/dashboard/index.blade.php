@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Employees</h1> 
                            <h2><i class="fa fa-users"></i> 
                                {{$employees}}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Interns</h1> 
                                <h2><i class="fa fa-child"></i> 
                                {{$interns}}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Active</h1> 
                            <h2><i class="fa fa-street-view"></i>
                                {{$active}}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Inactive</h1> 
                            <h2><i class="fa fa-user-times"></i>
                                {{$inactive}}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Late</h1> 
                            <h2><i class="fa fa-times"></i> 
                               {{$lateToday}}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-bottom-primary">
                        <div class="card-body">
                            <h1 class="display-4">Under Time</h1> 
                            <h2><i class="fa fa-calendar-times-o"></i> 
                                {{$underTimeToday}}</a>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-12 mb-3">
                <div class="card bg-gradient-primary text-white">
                    <div class="card-body align-items-center">
                        <h1 id="displayTime" class="display-4"></h1>
                        <h4 id="displayDate"></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card bg-gradient-success text-white">
                    <div class="card-body" style="line-height: 1rem;">
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

            if(hrs >= 12){
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
    });
</script>
@endsection