@extends('layouts.app')

@section('content')

<h4>{{ count($interns) <= 0 ? 'There is No Data....' : 'Interns'}}</h4>

@if(count($interns) > 0)
	<table class="table table-hover table-responsive-sm">
		<tr class="bg-secondary text-white">
			<th>Name</th>
			<th>ID</th>
			<th>Gender</th>
			<th>Contact</th>
			<th>Email</th>
			<th>Department</th>
		</tr>
		@foreach($interns as $intern)
			<tr>
				<td><a href="{{route('register.show', $intern->id)}}">{{$intern->getFullNameAttribute()}}</a></td>
				<td>{{$intern->id_number}}</td>
				<td>{{$intern->gender}}</td>
				<td>{{$intern->contact}}</td>
				<td>{{$intern->email}}</td>
				<td>{{$intern->department}}</td>
			</tr>
		@endforeach
	</table>
	{{$interns->links()}}
@else

<h1 class="display-4">There's no data to show...</h1>
@endif


@endsection