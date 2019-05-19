<template>
	<div class="row justify-content-center">
	    <div class="col-md-4 col-sm-4">
	       <h3 align="center" class="display-4 text-secondary"><i class="fa fa-qrcode"></i> QR CODE TESTER</h3>		
	       <!-- two components -->
	   			<testdragin  v-if="buttonTitle == 'Switch to Scanner'"></testdragin>
					<testscanner v-else></testscanner>
					<!-- toggle between two components -->
					<button @click="btn()" class="btn btn-outline-dark btn-block mt-3">
							<i class="fa fa-random"></i>	{{ buttonTitle }}
					</button>
			</div>
	</div>
</template>
<script type="text/javascript">
		import testscanner from './TesterScanner.vue';
		import testdragin from './TesterDragIn.vue';

		export default{
			components: {
				testscanner, testdragin
			},
			data(){
				return{
					buttonTitle: 'Switch to Drag In Drop'
				}
			},
			methods:{
					btn(){
							// change the button title
							if(this.buttonTitle == 'Switch to Drag In Drop'){
									this.buttonTitle = 'Switch to Scanner'
							}else{
									this.buttonTitle = 'Switch to Drag In Drop'
							}
					}
			}
		}
</script>
