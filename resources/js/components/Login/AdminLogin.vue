<template>
  <div class="row justify-content-center mt-5">
    <div class="col-md-3">
      <h3 class="text-info display-4" align="center"><i class="fa fa-user-circle"></i> Admin Log In</h3>
     <!--  <p class="error">{{ error }}</p> -->
    <!--   <p class="decode-result">Last result: <b class="text-warning">{{ result }}</b></p> -->
      <qrcode-stream @decode="onDecode" @init="onInit" class="qrcodeBox"/>
      <p data-aos-delay="2000" align="center" class="text-white mt-2">powered by <i class="fa fa-code"></i> codehive</p>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      result: '',
      error: '',
      message: {}
    }
  },
  methods: {
    onDecode (result) {
      let password = result;

      axios.post('/admin/login',{
        password: password

      }).then(response =>{
              
        window.location = response.data.redirect
        
      }).catch(error => {
          if(error.response.status == 422){
              this.message = error.response.data.message

              this.$toast.error('<strong>' + this.message + '</strong>', 'Error',{
                icon: 'ico-warning',
                position: 'topCenter',
                transitionOut: 'fadeOutUp'
              });  

          }else{
              this.$toast.error('Server Error Please Try Again', 'Error',{
                position: 'topCenter',
                transitionOut: 'fadeOutUp'
              })
          }
      })
    },

    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = "ERROR: you need to grant camera access permisson"
        } else if (error.name === 'NotFoundError') {
          this.error = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
          this.error = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
          this.error = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
          this.error = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.error = "ERROR: Stream API is not supported in this browser"
        }
      }
    }
  }
}
</script>

<style scoped>
.error {
  font-weight: bold;
  color: red;
}
.qrcodeBox{
  border: 2px #fff solid;
}
</style>