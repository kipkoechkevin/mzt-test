<template>
  <div class="relative">
    <div
        class="fixed bottom-0 right-0 p-4 mb-4 text-sm text-green-700 bg-green-100 w-60 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert" v-show="show">
      <span class="font-medium">Success!!</span> {{ body }}
    </div>
  </div>

</template>
<script>
export default {
  props: ['message'],
  data() {
    return {
      body: '',
      show: false
    }
  },
  created() {
    if(this.message) {
      this.flash(this.message)
    }
    window.events.$on('flash',(message) => this.flash(message))
  },
  methods: {
    flash(message) {
      this.show = true
      this.body = message

      setTimeout(() => {
        this.hide()
      },7000)
    },
    hide() {
      this.show = false
    }
}
}

</script>