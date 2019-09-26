@extends('layouts.app')

@section('content')

<h4>{{count($activeUsers) <= 0 ? 'There is No Data....' : 'Active'}}</h4>

@if(count($activeUsers) > 0)
	<table class="table table-striped table-hover table-responsive-md">
		<tr class="text-white bg-secondary">
				<th>Name</th>
				<th>Log In</th>
				<th>Late (hr)</th>
				<th>Status</th>
		</tr>
		@foreach($activeUsers as $active)
			<tr>
				<td>{{$active->name}}</td>
				<td>{{$active->log_in->format('m-j-Y h:iA' )}}</td>
				<td>{{$active->late}}</td>
				<td><strong class="text-success">{{$active->status}}</strong></td>
			</tr>		
		@endforeach
	</table>
	{{$activeUsers->links()}}	
@endif

@endsection