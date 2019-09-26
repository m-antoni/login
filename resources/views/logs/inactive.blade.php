@extends('layouts.app')

@section('content')


<h4>{{ count($inactiveUsers) <= 0 ? 'There is No Data....' : 'Inactive'}}</h4>

@if(count($inactiveUsers) > 0)
	<table class="table table-striped table-hover table-responsive-md">
				<tr class="text-white bg-secondary">
						<th>Name</th>
						<th>Log In</th>
						<th>Log Out</th>
						<th>Status</th>
				</tr>
			@foreach($inactiveUsers as $inactive)
				<tr>
					<td>{{$inactive->name}}</td>
					<td>{{$inactive->log_in->format('m-j-Y h:iA' )}}</td>
					<td>{{($inactive->log_out ? $inactive->log_out->format('m-j-Y h:iA') : '')}}</td>
					<td><strong class="text-danger">{{$inactive->status}}</strong></td>
				</tr>		
			@endforeach
	</table>
	{{$inactiveUsers->links()}}	
@endif


@endsection