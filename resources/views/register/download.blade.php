@extends('layouts.app')

@section('content')
	
<div class="container">	
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div align="center">
				<img src="/img/qrcode.png" class="img-thumbnail mt-2" style="width: 300px;">
				<div class="form-group">
					<a href="{{route('register.downloadfile')}}" class="btn btn-primary my-3">
						<i class="fa fa-download"></i> Donwload QR Code
					</a>
				</div>
			</div>
		</div>	
	</div>
</div>

@endsection
