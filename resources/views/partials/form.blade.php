<div class="form-group row">
   	<div class="col-md-3">
        <label>First:</label>
        <input type="text" name="first" class="form-control{{ $errors->has('first') ? ' is-invalid' : '' }}" 
        value="{{ old('first') ?? $register->first}}">
        @if ($errors->has('first'))
            <span class="text-danger" role="alert">
                {{ $errors->first('first') }}
            </span>
        @endif
    </div>

    <div class="col-md-3">
        <label>Last:</label>
        <input type="text" name="last" class="form-control{{ $errors->has('last') ? ' is-invalid' : '' }}" 
        value="{{ old('last') ?? $register->last}}">
        @if ($errors->has('last'))
            <span class="text-danger" role="alert">
                {{ $errors->first('last') }}
            </span>
        @endif
    </div>

    <div class="col-md-3">
        <label>Middle:</label>
        <input type="text" name="middle" class="form-control" value="{{ old('middle') ?? $register->middle}}">
    </div>

    <div class="col-md-3">	
	    <label>Gender:</label>
        <select name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
        <option value="" selected disabled>Choose here...</option>
		  <option value="Male" {{old('gender', $register->gender) == 'Male' ? 'selected' : '' }}>Male</option>
		  <option value="Female" {{old('gender', $register->gender) == 'Female' ? 'selected' : ''}}>Female</option>
		</select>

        @if ($errors->has('gender'))
            <span class="text-danger" role="alert">
                {{ $errors->first('gender') }}
            </span>
        @endif
    </div>	
    
</div>

<div class="form-group row">
    <div class="col-md-3">  
        <label>Age:</label>
       <input type="text" name="age" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" 
       value="{{ old('age') ?? $register->age }}">
        @if ($errors->has('age'))
            <span class="text-danger" role="alert">
                {{ $errors->first('age') }}
            </span>
        @endif
    </div>  

	<div class="col-md-3">	
     <label>Birthday:</label>
        <input type="date" name="birthday" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" 
        value="{{ old('birthday') ?? $register->birthday }}">
        @if ($errors->has('birthday'))
            <span class="text-danger" role="alert">
                {{ $errors->first('birthday') }}
            </span>
        @endif
	</div>

	<div class="col-md-3">	
     <label>Contact:</label>
        <input type="text" name="contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" 
        value="{{ old('contact') ?? $register->contact}}">
        @if ($errors->has('contact'))
            <span class="text-danger" role="alert">
                {{ $errors->first('contact') }}
            </span>
        @endif
	</div>

	<div class="col-md-3">	
    	<label>Email address:</label>
    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
    name="email" value="{{ old('email') ?? $register->email}}">
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
      <textarea name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') ?? $register->address}}</textarea>
        @if ($errors->has('address'))
            <span class="text-danger" role="alert">
                {{ $errors->first('address') }}
            </span>
        @endif
    </div>

    <div class="col-md-4">
        <label>Department:</label>
        <select name="department" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}">
        	@foreach($register->departmentOption() as $departmentOptionKey => $departmentOptionValue)
    			<option value="{{$departmentOptionKey}}" {{ $register->department == $departmentOptionValue ? 'selected' : '' }}>{{$departmentOptionValue}}
                </option>
        	@endforeach
		</select>
        
        @if ($errors->has('department'))
            <span class="text-danger" role="alert">
                {{ $errors->first('department') }}
            </span>
        @endif
    </div>

  	<div class="col-md-4">	
        <label>Date Hired:</label>
        <input type="date" name="date_hired" class="form-control{{ $errors->has('date_hired') ? ' is-invalid' : '' }}" value="{{ old('date_hired') ?? $register->date_hired }}">
        @if ($errors->has('date_hired'))
            <span class="text-danger" role="alert">
                {{ $errors->first('date_hired') }}
            </span>
        @endif
	</div>
</div>

<div class="form-group row">
	<div class="col-md-4">
        <label>Set ID Number:</label>
        <input id="password" type="text" name="id_number" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" 
        name="id_number" value="{{ old('id_number') ?? $register->id_number}}">
        @if ($errors->has('id_number'))
            <span class="text-danger" role="alert">
                {{ $errors->first('id_number') }}
            </span>
        @endif
  	</div>

    <div class="col-md-3">    
        <label>User Type:</label>
        <select name="user_type" class="form-control{{ $errors->has('user_type') ? ' is-invalid' : '' }}">
            <option value="" selected disabled>Choose here...</option>
            <option value="Employee" {{old('user_type' , $register->user_type) == 'Employee' ? 'selected' : ''}}>Employee</option>
            <option value="Intern" {{old('user_type' , $register->user_type) == 'Intern' ? 'selected' : ''}}>Intern</option>
            </select>
        @if ($errors->has('user_type'))
            <span class="text-danger" role="alert">
                {{ $errors->first('user_type') }}
            </span>
        @endif
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">
           <i class="fa fw fa-user-circle"></i> {{Request::is('admin/register/create') ? 'Add New User' : 'Update User'}}
        </button>
    </div>
</div>