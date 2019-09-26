@extends('layouts.app')

@section('content')

<div class="container">
	<h4>Add New</h4>
	<div class="card border-left-primary">
		<div class="card-body">
			<form method="POST" action="{{ route('register.store') }}">
				@csrf
				@include('partials.form')
			</form>
		</div>
	</div>
</div>

@endsection


