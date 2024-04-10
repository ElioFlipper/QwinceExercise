<script>
import Navbar from "./Navbar.vue"
export default {
  components: {
    Navbar
    
  }
}
</script>

<template>
  <Navbar />
  <div id="app">
    <router-view />
  </div>
</template>
<style lang="scss">
@import '@/App.scss'
</style>