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
						<th>Log In</th>
						<th>Log Out</th>
						<th>Late</th>
						<th>Under</th>
						<th>Status</th>
						<th>Total</th>
						<th>Action</th>
				</tr>
	 		@foreach($logs as $log)
	 			<tr>
	 					<td><a href="{{route('register.show', $log->register_id)}}">{{$log->name}}</a></td>
	 					<td>{{$log->log_in->format('m-j-Y h:iA' )}}</td>
						<td>{{($log->log_out ? $log->log_out->format('m-j-Y h:iA') : '')}}</td>
						<td>{{($log->late == 1 ? '1 hr' : $log->late . ' hrs')}}</td>
						<td>{{($log->under == 0 ? '0' : $log->under . ' hrs')}}</td>
						{{-- <td>{{($log->log_out != null ? $log->log_out->diffInHours($setTimeToEnd) . ' hrs' : '')}}</td> --}}
	 					<td><strong class={{($log->status == 'active' ? 'text-success': 'text-danger')}}>{{$log->status}}</strong></td>
	 					<td>{{($log->log_out == null ? '' : $log->log_in->diffForHumans($log->log_out))}}</td>
	 					<td>
	 							<form action="{{route('log.delete', $log->id)}}" method="POST" align="center">
	 									@csrf
	 									@method('DELETE')	
	 									<button type="submit" class="btn btn-sm btn-outline-danger btn-block">
	 											<i class="fa fa-times"></i>
	 									</button>
	 							</form>
	 					</td>
	 			</tr>
	 		@endforeach
	 	@else
	 		<h1 class="display-4">There is no data to show...</h1>
	 	@endif
 </table>
{{--  pagintation --}}
 {{$logs->links()}}

@endsection