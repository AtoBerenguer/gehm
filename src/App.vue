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

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

th, td {
  padding: 12px 15px;
  border: 1px solid #ddd;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

/* Botón */
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

button:hover {
  background-color: white;
  color: black;
  border: 2px solid #4CAF50;
}
</style>
