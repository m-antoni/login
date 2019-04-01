@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="clock"></div>
         </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5 mt-2">
            <div class="card" style="border: 0;">
                <div class="card-header bg-dark text-white">
                    <h1 align="center" class="display-4">
                        <i class="fa fw fa-user-circle"></i> Admin Login
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        @include('partials.login')
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
