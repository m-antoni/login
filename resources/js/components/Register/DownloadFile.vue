<template>
<div>	
	<div>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item active">
		    <a href="/admin/register">users</a>
		  </li>
		  <li class="breadcrumb-item">
		    	create
		  </li>
		  <li class="breadcrumb-item">
		    	download
		  </li>
		</ol>
	</div>
	<div class="row justify-content-center">
			<div class="col-md-4">
					<div align="center">
							<img src="/img/qrcode.png" class="img-thumbnail mt-2">
							<div class="form-group">
										<a @click="download()" href="/admin/register/downloadfile" class="btn btn-outline-info my-3">
											<i class="fa fa-download"></i> {{title}}
										</a>
							</div>
					</div>
			</div>	
	</div>
</div>
</template>
<script type="text/javascript">
	export default{
		data(){
			return {
				title: 'Download QR Code',
			}
		},
		methods:{
			download(e){
				e.preventDefault();
			}
		}
}
</script>

<style scoped>
img{
	width: 200px;
}	

</style>