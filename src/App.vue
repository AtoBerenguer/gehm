<template>
  <div id="app" class="app-container">
    <HeaderComponent class="headerComponent" v-if="!isLoginRoute"></HeaderComponent>
    <router-view class="mainComponent"></router-view>
    <FooterComponent class="footerComponent" v-if="!isLoginRoute"></FooterComponent>
  </div>
</template>

<script>
import HeaderComponent from './components/shared/headerComponent.vue';
import FooterComponent from './components/shared/footerComponent.vue';
import { computed } from 'vue';
import { useRoute } from 'vue-router';
 


export default {
  name: 'App',
  
  components: {
    HeaderComponent,
    FooterComponent
  },
  setup() {
    const route = useRoute();
    const isLoginRoute = computed(()=>route.path === '/');
    return {
      isLoginRoute
    };
  },
  
}
</script>

<style>

body {
  margin: 2rem;
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
  background-color: #000000;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  display: flex;
  height: 93vh;
  width: 100%;
}

.headerComponent, .footerComponent {
  height: 7vh;
  display: flex;
  align-items: center;

}
.mainComponent {
  flex-grow: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  
}





</style>
