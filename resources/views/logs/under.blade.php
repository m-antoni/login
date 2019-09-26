@extends('layouts.app')

@section('content')
<h4>{{count($under) <= 0 ? 'There is No Data....' : 'Under Time'}}</h4>

@if(count($under) > 0)
	<table class="table table-striped table-hover table-responsive-md">
		<tr class="text-white bg-secondary">
			<th>Name</th>
			<th>Log In</th>
			<th>Log Out</th>
			<th>Late (hr)</th>
			<th>Under Time (hr)</th>
		</tr>
		@foreach($under as $user)
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->log_in->format('m-j-Y h:iA' )}}</td>
				<td>{{($user->log_out ? $user->log_out->format('m-j-Y h:iA') : '')}}</td>
				<td>{{$user->late}}</td>
				<td>{{$user->under}}</td>
			</tr>		
		@endforeach
	</table>
	{{$under->links()}}
@endif

@endsection