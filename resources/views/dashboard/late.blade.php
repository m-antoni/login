@extends('layouts.app')

@section('content')
<div class="container">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item">
		    		<a href="{{route('dashboard')}}">dashboard</a>
		    </li>
		    <li class="breadcrumb-item text-secondary">
		    		late
		    </li>
		</ol>

		@if(count($lates) > 0)
		<table class="table table-striped table-hover table-responsive-md">
					<tr class="text-white bg-secondary">
							<th>Name</th>
							<th>Log In</th>
							<th>Log Out</th>
							<th>Late</th>
							<th>Status</th>
					</tr>
				@foreach($lates as $late)
					<tr>
							<td>{{$late->name}}</td>
							<td>{{$late->log_in->format('m-j-Y h:iA' )}}</td>
							<td>{{($late->log_out ? $late->log_out->format('m-j-Y h:iA') : '')}}</td>
							<td>{{($late->late == 1 ? '1 hr' : $late->late . ' hrs')}}</td>
							<td><strong class={{($late->status == 'active' ? 'text-success': 'text-danger')}}>{{$late->status}}</strong></td>
					</tr>		
				@endforeach
			
			@else
				<h1 class="display-4">There's no data to show...</h1>
			@endif
		</table>
		{{$lates->links()}}
</div>
@endsection