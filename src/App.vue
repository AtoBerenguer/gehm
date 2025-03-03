<template>
  <div id="app" class="app-container">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  components: {}
}
</script>

<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #000000;
  color: #333;
}

#app {
  
  flex-direction: column;
  align-items: center;
  justify-content: center;
  
  text-align: center;
}

.app-container {
  padding: 20px;
  background-color: #000000;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}






</style>
