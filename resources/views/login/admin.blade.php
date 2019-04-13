@extends('layouts.app')

@section('content')
    {{-- <div class="clock" align="center"></div> --}}

    {{-- admin-login component --}}
    <admin-login></admin-login>    

@endsection

@section('script')

    <script type="text/javascript">
        // $(document).ready(function() {
            // let clock;
            //     clock = $('.clock').FlipClock({
            //       clockFace: 'TwelveHourClock'
            // });
        // });
    </script>

@endsection
