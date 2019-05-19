<template>
  <div class="row justify-content-center mt-5">
    <div class="col-md-3">
      <h3 class="text-info display-4" align="center"><i class="fa fa-qrcode"></i> QR Code Scanner</h3>
     <!--  <p class="error">{{ error }}</p> -->
    <!--   <p class="decode-result">Last result: <b class="text-warning">{{ result }}</b></p> -->
      <qrcode-stream @decode="onDecode" @init="onInit" class="qrcodeBox"/>
      <p align="center" class="text-white">powered by <i class="fa fa-code mt-2"></i> codehive</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      result: '',
      error: ''
    }
  },
  methods: {
    onDecode (result) {
      this.result = result
       axios.post('/login',{
            qrcode: this.result
       }).then(response => {
            // response message
            if(response.data.message){
                // <strong>' + response.data.message + '</strong>
                this.$toast.show(`<strong>${response.data.message}</strong>`, '', {
                    // icon: 'fa fa-user-circle',
                    image: response.data.image,
                    imageWidth: 60,
                    messageSize: 21,
                    iconColor: 'rgb(0, 255, 184)',
                    theme: 'dark',
                    progressBarColor: 'rgb(0, 255, 184)',
                    position: 'topCenter',
                    transitionIn: 'bounceInUp',
                    transitionOut: 'fadeOutUp',
                });
            }else if(response.data.wrong){
                this.$toast.show(`<strong>${response.data.wrong}</strong>`, '', {
                    // icon: 'fa fa-user-circle',
                    image: response.data.image,
                    imageWidth: 60,
                    messageSize: 21,
                    messageColor: 'lightpink',
                    iconColor: 'rgb(0, 255, 184)',
                    theme: 'dark',
                    progressBarColor: 'rgb(0, 255, 184)',
                    position: 'topCenter',
                    transitionIn: 'bounceInUp',
                    transitionOut: 'fadeOutUp',
                });
            }else{
                this.$toast.warning(`<strong> ${response.data.error}</strong>`, 'Warning', {
                    position: 'topCenter',
                    transitionIn: 'bounceInDown',
                    transitionOut: 'fadeOutUp',
                });
            }
      }).catch(error => {
          // console.log(error)
          this.$toast.error(`<strong>${'QR Code is not registered'}</strong>`, 'Error', {
              position: 'topCenter',
              progressBarColor: '#333',
              transitionIn: 'bounceInDown',
              transitionOut: 'fadeOutUp',
          });
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