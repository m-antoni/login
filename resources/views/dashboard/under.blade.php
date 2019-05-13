@extends('layouts.app')

@section('content')
<div class="container">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item">
		    		<a href="{{route('dashboard')}}">dashboard</a>
		    </li>
		    <li class="breadcrumb-item text-secondary">
		    		under time
		    </li>
		</ol>

		@if(count($under) > 0)
		<table class="table table-striped table-hover table-responsive-md">
					<tr class="text-white bg-secondary">
							<th>Name</th>
							<th>Log In</th>
							<th>Log Out</th>
							<th>Late</th>
							<th>Under Time</th>
					</tr>
				@foreach($under as $user)
					<tr>
							<td>{{$user->name}}</td>
							<td>{{$user->log_in->format('m-j-Y h:iA' )}}</td>
							<td>{{($user->log_out ? $user->log_out->format('m-j-Y h:iA') : '')}}</td>
							<td>{{($user->late == 1 ? '1 hr' : $user->late . ' hrs')}}</td>
							<td>{{$user->under == 1 ? '1 hr' : $user->under . ' hrs'}}</td>
					</tr>		
				@endforeach
			
			@else
				<h1 class="display-4">There's no data to show...</h1>
			@endif
		</table>
		{{$under->links()}}
</div>
@endsection