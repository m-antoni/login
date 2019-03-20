@extends('layouts.app')

@section('content')

 <ol class="breadcrumb">
    <li class="breadcrumb-item">
      	users
    </li>
    <li class="breadcrumb-item active">
      	<a href="{{route('register.create')}}">create</a>
    </li>
 </ol>

 <table class="table table-hover table-striped table-responsive-sm">
				<tr class="bg-dark text-info">
	 				<th>name</th>
	 				<th>id no</th>
	 				<th>contact</th>
	 				<th>department</th>
	 				<th>user type</th>
				</tr>
 		@if(count($registers) > 0)
	 		@foreach($registers as $register)
	 			<tr>
	 					<td><a href="{{route('register.show', $register->id)}}">{{$register->last . ', ' . $register->first}}</a></td>
	 					<td>{{$register->id_number}}</td>
	 					<td>{{$register->contact}}</td>
	 					<td>{{$register->department}}</td>
	 					<td>{{$register->user_type}}</td>
	 			</tr>
	 		@endforeach
	 	@else
	 		<h2>There is no data</h2>
	 	@endif
 </table>

@endsection