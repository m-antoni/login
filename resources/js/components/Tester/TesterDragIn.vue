<template>
  <div>
     <!--  <p class="decode-result">Last result: <b>{{ result }}</b></p> -->
      <qrcode-drop-zone @detect="onDetect" @dragover="onDragOver" @init="logErrors">
        <div class="drop-area" :class="{ 'dragover': dragover }">
          DROP SOME IMAGES HERE
        </div>
      </qrcode-drop-zone>
  </div>
</template>

<script>
export default {
  data () {
    return {
      result: null,
      error: null,
      dragover: false
    }
  },
  methods: {
    async onDetect (promise) {
    try {
        const { content } = await promise

        //this.result = content
        this.error = null

        this.$toast.show(this.result = content, 'Decode:',{
            icon: 'fa fa-qrcode',
            iconColor: 'rgb(0, 255, 184)',
            theme: 'dark',
            progressBarColor: 'rgb(0, 255, 184)',
            position: 'topCenter',
            transitionIn: 'bounceInUp',
            transitionOut: 'fadeOutUp',
        })

      } catch (error) {
        if (error.name === 'DropImageFetchError') {
          // this.error = 'Sorry, you can\'t load cross-origin images :/'
          this.$toast.error(this.error = 'Sorry, you can\'t load cross-origin images :/', 'Error',{
              icon: 'ico-warning',
              position: 'topCenter',
              transitionOut: 'fadeOutUp'
            });

        } else if (error.name === 'DropImageDecodeError') {
          //this.error = 'Ok, that\'s not an image. That can\'t be decoded.'
            this.$toast.error(this.error = 'That\'s not an image. That can\'t be decoded.', 'Error',{
              icon: 'ico-warning',
              position: 'topCenter',
              transitionOut: 'fadeOutUp'
            });
        } else {
          // this.error = 'Ups, what kind of error is this?! ' + error.message
          this.$toast.error(this.error = 'Ups, what kind of error is this?!' + error.message, 'Error',{
              icon: 'ico-warning',
              position: 'topCenter',
              transitionOut: 'fadeOutUp'
            });
        }
      }
    },

    logErrors (promise) {
      promise.catch(console.error)
    },

    onDragOver (isDraggingOver) {
      this.dragover = isDraggingOver
    }
  }
}
</script>

<style scope>
.drop-area {
  height: 300px;
  color: #fff;
  text-align: center;
  font-weight: bold;
  padding: 10px;
  background-color: rgba(0,0,0,.5);
}
.text-warning{
  font-size: 1.2rem;
}
.dragover {
  background-color: rgba(0,0,0,.8);
}
.drop-error {
  color: red;
  font-weight: bold;
}
</style>
