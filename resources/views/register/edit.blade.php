@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item active">
    <a href="{{route('register.index')}}">users</a>
  </li>
  <li class="breadcrumb-item">
    	<a href="{{route('register.show', $register->id)}}">show</a>
  </li>
  <li class="breadcrumb-item">
    	edit
  </li>
</ol>

<div class="card mt-2 mb-5">
	<div class="card-body">
			<form method="POST" action="{{ route('register.update', $register->id) }}">
				@method('PATCH')
				@csrf

				@include('partials.form')
			</form>
	</div>
</div>

@endsection