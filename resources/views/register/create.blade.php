@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item active">
    <a href="{{route('register.index')}}">users</a>
  </li>
  <li class="breadcrumb-item">
    	create
  </li>
</ol>

<div class="card mt-2 mb-5">
	<div class="card-body">
			<form method="POST" action="{{ route('register.store') }}">
				@csrf
					@include('partials.form')
			</form>
	</div>
</div>

@endsection