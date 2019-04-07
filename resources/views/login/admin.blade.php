@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="clock"></div>
         </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="border: 0;">
                <div class="card-header bg-dark text-white">
                    <h1 align="center" class="display-4">
                        <i class="fa fw fa-user-circle"></i> Admin Login
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                       {{-- Admin Login form --}}
                        <div class="form-group row">
                      {{--       <div class="col-md-12">
                                <label><i class="fa fa-user-circle"></i> USERNAME:</label>
                                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="text-danger" role="alert">
                                        {{ $errors->first('username') }}
                                    </span>
                                @endif
                            </div> --}}
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
                                <button type="submit" class="btn btn-dark btn-lg btn-block">
                                   Submit
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

@section('script')

    <script type="text/javascript">
        // $(document).ready(function() {
            let clock;
                clock = $('.clock').FlipClock({
                  clockFace: 'TwelveHourClock'
            });
        // });
    </script>

@endsection
