@extends('layouts.app')

@section('content')
	
<div class="container">	
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div id="errors"></div>

			<div id="output" align="center" style="display: none; margin: 50px;">
	            <div style="width: 200px;">
	            	<h2 class="text-success"><i class="fa fa-check-circle fa-5x"></i> <b>Success!</b></h2>
	            	<h4>Please wait...</h4>
	            </div>
	        </div>

			<div id="downloadForm" align="center">
				<img src="/img/qrcode.png" class="img-thumbnail mt-2 border-dark" style="width: 250px;">
				<div class="form-group">
					<a href="{{route('register.downloadfile')}}" class="btn btn-primary my-3">
						<i class="fa fa-download"></i> DOWNLOAD QR CODE
					</a>
				</div>
			</div>
		</div>	
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
	$.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

	$('a').on('click', function(){

		$('#output').show();
		$('#downloadForm').hide();

		setInterval(function(){
			window.location = '{{route('register.index')}}';
		},2000);

	});
});
</script>
@endsection
