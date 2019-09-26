@extends('layouts.app')

@section('content')

<div class="container">
  <div class="card border-left-primary">
    <div class="card-header">
      <div class="row">
        <div class="ml-1">
          <h3 class="display-4"><i class="fa fa-user-circle"></i> Edit Information</h3>
        </div>
        <div class="ml-auto mr-md-1">
          <a class="btn btn-default" href="{{route('register.index')}}"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
      </div>
    </div>
  	<div class="card-body">
  			<form method="POST" action="{{ route('register.update', $register->id) }}">
  				@method('PATCH')
  				@csrf

  				@include('partials.form')
  			</form>
  	</div>
  </div>
</div>

@endsection