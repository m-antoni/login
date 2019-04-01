@if(Request::is('admin/login'))

    {{-- Admin Login form --}}
    <div class="form-group row">
        <div class="col-md-12">
            <label><i class="fa fa-user-circle"></i> USERNAME:</label>
            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">

            @if ($errors->has('username'))
                <span class="text-danger" role="alert">
                    {{ $errors->first('username') }}
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <label><i class="fa fa-lock"></i> PASSWORD:</label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

            @if ($errors->has('password'))
                <span class="text-danger" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row mb-0 pt-4">
        <div class="col-md-12">
            <button type="submit" class="btn btn-dark btn-block">
               Admin
            </button>
             <a href="{{route('user.login')}}" class="btn btn-info btn-block">
               Log as user
            </a>
        </div>
    </div>

@else

    {{-- User Login form --}}
    <div class="form-group row">
        <div class="col-md-12">
            <label><i class="fa fa-user-circle"></i> ID NUMBER:</label>
            <input type="text" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="username" value="{{ old('id_number') }}">

            {{-- @if ($errors->has('id_number'))
                <span class="text-danger" role="alert">
                    {{ $errors->first('id_number') }}
                </span>
            @endif --}}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <label><i class="fa fa-lock"></i> PASSWORD:</label>
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

    {{--         @if ($errors->has('password'))
                <span class="text-danger" role="alert">
                    {{ $errors->first('password') }}
                </span>
            @endif --}}
        </div>
    </div>
        
    <div class="form-group row mb-0 pt-4">
        <div class="col-md-12">
            <a href="{{route('login')}}" class="btn btn-dark btn-block">
               Admin
            </a>
             <button type="submit" class="btn btn-info btn-block">
               User
            </button>
        </div>
    </div>

@endif