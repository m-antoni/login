@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
	  <li class="breadcrumb-item">
	    	<a href="{{route('register.index')}}">users</a>
	  </li>
	  <li class="breadcrumb-item">
	    	<a href="{{route('register.create')}}">create</a>
	  </li>
	  <li class="breadcrumb-item active">
	  		<a href="{{route('register.show', $register->id)}}">show</a>
	  </li>
   	<li class="breadcrumb-item active">
  		edit
  	</li>
</ol>

<div class="card">
		<div class="card-body">
				<img src="{{asset('img/default.jpg')}}" class="img-thumbnail border-secondary mb-2" style="width: 250px">

				<form method="POST" action="" enctype="multipart/data">
						@csrf
						<input type="file" name="photo">
						<br> <br>
						<buttin href="#" class="btn btn-info">
							<i class="fa fw fa-image"></i> Update
						</button>
				</form>
		</div>
</div>

@endsection