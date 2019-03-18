@extends('layouts.app')

@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item active">
    <a href="{{route('register')}}">register</a>
  </li>
  <li class="breadcrumb-item">
    create
  </li>
</ol>

<div class="card mt-2 mb-5">
	<div class="card-body">
			<form method="POST" action="{{ route('register.created') }}">

				@csrf
				
				<div class="form-group row">
				    <div class="col-md-4">
				        <label>First:</label>
				        <input type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('fullname') }}">
				        @if ($errors->has('fullname'))
				            <span class="text-danger" role="alert">
				                {{ $errors->fullname('fullname') }}
				            </span>
				        @endif
				    </div>

				    <div class="col-md-4">
				        <label>Last:</label>
				        <input type="text" class="form-control{{ $errors->has('last') ? ' is-invalid' : '' }}" name="last" value="{{ old('last') }}">
				        @if ($errors->has('last'))
				            <span class="text-danger" role="alert">
				                {{ $errors->last('last') }}
				            </span>
				        @endif
				    </div>

				    <div class="col-md-4">
				        <label>Middle:</label>
				        <input type="text" class="form-control{{ $errors->has('middle') ? ' is-invalid' : '' }}" name="middle" value="{{ old('middle') }}">
				        @if ($errors->has('middle'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('middle') }}
				            </span>
				        @endif
				    </div>

				</div>

				<div class="form-group row">
						<div class="col-md-4">	
					    	<label>Gender:</label>
				        <select class="form-control">
						      <option>Male</option>
						      <option>Female</option>
						    </select>

				        @if ($errors->has('gender'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('gender') }}
				            </span>
				        @endif
						</div>	

						<div class="col-md-4">	
					     <label>Contact:</label>
					        <input type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}">
					        @if ($errors->has('contact'))
					            <span class="text-danger" role="alert">
					                {{ $errors->first('contact') }}
					            </span>
					        @endif
						</div>

						<div class="col-md-4">	
					    	<label>Email address:</label>
				        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
				        @if ($errors->has('email'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('email') }}
				            </span>
				        @endif
						</div>			
				</div>

				<div class="form-group row">
				    <div class="col-md-4">
				        <label>Address:</label>
				        <textarea  class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" rows="3"></textarea>
				        @if ($errors->has('address'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('address') }}
				            </span>
				        @endif
				    </div>

				    <div class="col-md-4">
				        <label>Department:</label>
				        <select class="form-control">
						      <option>Office of the President</option>
						      <option>Human Resource</option>
						      <option>Purchasing (Procurement)</option>
						      <option>Accounting</option>
						      <option>Design & Engineering</option>
						      <option>IT Dept.</option>
						      <option>Maintenance</option>
						      <option>Security</option>
						    </select>

				        @if ($errors->has('department'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('department') }}
				            </span>
				        @endif
				    </div>

				    <div class="col-md-4">    
				        <label>User Type:</label>
				        <select class="form-control">
						      <option>Employee</option>
						      <option>Intern</option>
						    </select>
				        @if ($errors->has('user_type'))
				            <span class="text-danger" role="alert">
				                {{ $errors->first('password') }}
				            </span>
				        @endif
				       
			    	</div>
				</div>

				<div class="form-group row">
				   	<div class="col-md-4">
				        <label>Set Password:</label>
				        <input type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
				        @if ($errors->has('password'))
				            <span class="text-danger" role="alert">
				                {{ $errors->password('password') }}
				            </span>
				        @endif
			    	</div>
				 </div>

				<div class="form-group row mb-0">
				    <div class="col-md-12">
				        <button type="submit" class="btn btn-info">
				            {{ __('Create New User') }}
				        </button>
				    </div>
				</div>
			</form>
	</div>
</div>


@endsection