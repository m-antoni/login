@extends('layouts.app')

@section('content')

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4><i class="fa fa-user-shield"></i> Admin Login</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Username:</label>
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
                                <label>Password:</label>
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                       {{--  <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row mb-0 pt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-info btn-block">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
