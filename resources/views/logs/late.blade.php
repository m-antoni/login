@extends('layouts.app')

@section('content')

<h4>{{count($lates) <= 0 ? 'There is No Data....' : 'Late'}}</h4>

@if(count($lates) > 0)
	<table class="table table-striped table-hover table-responsive-md">
		<tr class="text-white bg-secondary">
			<th>Name</th>
			<th>Log In</th>
			<th>Log Out</th>
			<th>Late (hr)</th>
			<th>Status</th>
		</tr>
		@foreach($lates as $late)
			<tr>
				<td>{{$late->name}}</td>
				<td>{{$late->log_in->format('m-j-Y h:iA' )}}</td>
				<td>{{($late->log_out ? $late->log_out->format('m-j-Y h:iA') : '')}}</td>
				<td>{{$late->late}}</td>
				<td><strong class={{($late->status == 'active' ? 'text-success': 'text-danger')}}>{{$late->status}}</strong></td>
			</tr>		
		@endforeach
	</table>
	{{$lates->links()}}
@endif


@endsection