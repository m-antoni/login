@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
      	logs
    </li>
 </ol>

	{{--  alert messages --}}
	@include('partials.message')
 		@if(count($logs) > 0)
 		 	<table class="table table-hover table-responsive-sm">
				<tr class="text-white bg-secondary">
						<th>Name</th>
						<th>ID</th>
						<th>In</th>
						<th>Out</th>
						<th>Date</th>
						<th>Hours</th>
						<th>Late</th>
				</tr>
	 		@foreach($logs as $log)
	 			<tr>
	 					<td><a href="">{{$log->name}}</a></td>
	 					<td>{{$log->id_number}}</td>
	 					<td>{{$log->time_in}}</td>
	 					<td>{{$log->time_out}}</td>
	 					<td>{{$log->date}}</td>
	 					<td>{{$log->hours}}</td>
	 			</tr>
	 		@endforeach
	 	@else
	 		<h1 class="display-4">There is no data to show...</h1>
	 	@endif
 </table>
{{--  pagintation --}}
 {{$logs->links()}}

@endsection