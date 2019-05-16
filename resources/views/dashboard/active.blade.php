@extends('layouts.app')

@section('content')
<div class="container">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item">
		    		<a href="{{route('dashboard')}}">dashboard</a>
		    </li>
		    <li class="breadcrumb-item text-secondary">
		    		active
		    </li>
		</ol>

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
			
			@else
				<h1 class="display-4">There's no data to show...</h1>
			@endif
		</table>
		{{$activeUsers->links()}}
</div>
@endsection