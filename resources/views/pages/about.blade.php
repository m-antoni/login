@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="jumbotron py-3">
			  <h1 class="display-3">{{$info['title']}}</h1>
			 	<hr class="my-3">
			  <p class="lead"><i class="fa fa-code"></i> Attendance Monitoring System 1.0</p>
				<ul>
						<li>Create, update and delete users</li>
						<li>Upload user profile image</li>
						<li>Generate QR Code file</li>
						<li>Scans QR Code</li>
						<li>Error Handling</li>
						<li>Log active and inactive users</li>
						<li>Track the lates and under time</li>
						<li>Filter Employee and Interns records</li>
				</ul>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card bg-secondary text-white py-3">
				<div class="card-body">
						<h4 class="display-4">Contact</h4>
					  <hr class="my-3">
					  <p class="lead"><i class="fa fa-github"></i> {{$info['github']}}</p>
					  <p class="lead"><i class="fa fa-envelope"></i> {{$info['email']}}</p>
					  <p class="lead"><i class="fa fa-user-circle"></i> {{$info['name']}}</p>
				</div>
			</div>
		</div>
	</div>
</div>	

@endsection