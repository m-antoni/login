@extends('layouts.app')

@section('content')
	<h4>{{ count($employees) <= 0 ? 'There is No Data....' : 'Employees'}}</h4>

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

@endsection