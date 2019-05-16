@extends('layouts.app')

@section('content')
<div class="container">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item">
		    		<a href="{{route('dashboard')}}">dashboard</a>
		    </li>
		    <li class="breadcrumb-item text-secondary">
		    		inactive
		    </li>
		</ol>

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
			
			@else
				<h1 class="display-4">There's no data to show...</h1>
			@endif
		</table>
		{{$inactiveUsers->links()}}
</div>
@endsection