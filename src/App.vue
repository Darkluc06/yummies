<template>
  <div id="app-wrapper"> 
    <RouterView /> </div>
</template>

<script>
import { RouterView } from 'vue-router';

export default {
  name: 'App',
  components: {
    RouterView
  }
}
</script>