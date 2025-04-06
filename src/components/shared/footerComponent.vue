
<template>
  <footer class="footer">
    <div class="footer-content">
      <p>&copy; {{ new Date().getFullYear() }} Medical Equipment. Todos los derechos reservados.</p>
      <button v-if="rolId == '1'" @click="abrirModal()">Crear nuevo usuario</button>
    </div>
    <modalCrearUser v-if="mostrarModal" @cerrarModal="cerrarModal"/>
  </footer>
</template>
<script>
import modalCrearUser from './modalCrearUser.vue';
export default{
  components: {
    modalCrearUser,
  },
  data() {
    return {
      rolId: null,
      mostrarModal: false,
    };
  },
  mounted() {
    this.rolId = localStorage.getItem("rol_id");
   
    
  },
  methods: {
    abrirModal() {
      this.mostrarModal = true;
    },
    cerrarModal() {
      this.mostrarModal = false;
    },
  },
}
</script>
<style scoped>
.footer {
  background: linear-gradient(135deg, #303e4b, #1a3740);
  color: #ecf0f1;
  padding: 1.5rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  display: flex;
  flex-direction: row;
  align-items: center;
  width: 80%;
  margin: auto;
  margin-top: 1.5rem;
}

.footer-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.footer-nav {
  display: flex;
  gap: 20px;
}

.footer-nav a {
  color: #1abc9c;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease-in-out;
}

.footer-nav a:hover {
  color: #16a085;
}
</style>