@extends('layouts.app')

@section('content')
<div class="container">
		<ol class="breadcrumb">
		    <li class="breadcrumb-item">
		    		<a href="{{route('dashboard')}}">dashboard</a>
		    </li>
		    <li class="breadcrumb-item text-secondary">
		    		employees
		    </li>
		</ol>

		@if(count($employees) > 0)
			<table class="table table-hover table-responsive-sm">
					<tr class="bg-secondary text-white">
							<th>Name</th>
							<th>ID</th>
							<th>Gender</th>
							<th>Contact</th>
							<th>Email</th>
							<th>Department</th>
					</tr>
				@foreach($employees as $employee)
					<tr>
							<td><a href="{{route('register.show', $employee->id)}}">{{$employee->getFullNameAttribute()}}</a></td>
							<td>{{$employee->id_number}}</td>
							<td>{{$employee->gender}}</td>
							<td>{{$employee->contact}}</td>
							<td>{{$employee->email}}</td>
							<td>{{$employee->department}}</td>
					</tr>
				@endforeach
			</table>
			{{$employees->links()}}
		@else

		<h1 class="display-4">There's no data to show...</h1>
		@endif
</div>

@endsection