@extends('layouts.app')

@section('content')

<h4>{{count($logs) <= 0 ? 'There is No Data....' : 'Logs'}}</h4>
{{--  alert messages --}}
@include('partials.message')

@if(count($logs) > 0)
 	<table class="table table-hover table-responsive-sm">
	<tr class="text-white bg-secondary">
		<th>Name</th>
		<th>Log In</th>
		<th>Log Out</th>
		<th>Late (hr)</th>
		<th>Under (hr)</th>
		<th>Status</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
	@foreach($logs as $log)
		<tr>
			<td><a href="{{route('register.show', $log->register_id)}}">{{$log->name}}</a></td>
			<td>{{$log->log_in->format('m-j-Y h:iA' )}}</td>
			<td>{{($log->log_out ? $log->log_out->format('m-j-Y h:iA') : '')}}</td>
			<td>{{$log->late}}</td>
			<td>{{$log->under}}</td>
			{{-- <td>{{($log->log_out != null ? $log->log_out->diffInHours($setTimeToEnd) . ' hrs' : '')}}</td> --}}
				<td><strong class={{($log->status == 'active' ? 'text-success': 'text-danger')}}>{{$log->status}}</strong></td>
				<td>{{($log->log_out == null ? '' : $log->log_in->diffForHumans($log->log_out))}}</td>
				<td>
					<form action="{{route('log.delete', $log->id)}}" method="POST" align="center">
							@csrf
							@method('DELETE')	
							<button type="submit" class="btn btn-sm btn-circle btn-danger">
									<i class="fa fa-trash"></i>
							</button>
					</form>
				</td>
		</tr>
	@endforeach
	</table>	
	 {{--  pagintation --}}
 	{{$logs->links()}}
@endif




@endsection