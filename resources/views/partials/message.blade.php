{{-- Alert Messages --}}

@if(session('message'))

		<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong><i class="fa fw fa-check"></i> Success</strong> 
			  {{session('message')}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
		</div>
	{{-- <script type="text/javascript">
			iziToast.show({
				  title: 'Success',
				  message: '{{session('success')}}',
				 	icon: 'ico-success',
				  iconColor: 'rgb(0, 255, 184)',
				  theme: 'dark',
				  progressBarColor: 'rgb(0, 255, 184)',
				  position: 'topCenter',
				  transitionIn: 'fadeInLeft',
				  transitionOut: 'fadeOutUp'
			});
	</script> --}}

@endif
