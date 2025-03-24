<template>
  <div class="container">

    <div class="listaTareas">
      <h2 class="title">Lista de Tareas</h2>
      <DataTable :data="tareas" :headers="headers" :itemsPerPage="15" />

      <!-- <div class="containerLista">
        <div class="lista-titulos">
          <div class="lista titulo">Nº ticket</div>
          <div class="lista titulo">Fecha</div>
          <div class="lista titulo">Nº Equipo </div>
          <div class="lista titulo">Nombre Equipo</div>
          <div class="lista titulo">Avería</div>
          <div class="lista titulo">Estado</div>
          <div class="lista titulo">Acciones</div>
        </div>
        <div v-for="(tarea, index) in tareas" :key="tarea.id_ticket"
          :class="['lista-fila', index % 2 === 0 ? 'par' : 'impar']">
          <div class="lista">{{ tarea.id_ticket }}</div>
          <div class="lista">{{ tarea.fecha }}</div>
          <div class="lista">{{ tarea.equipoId }}</div>
          <div class="lista nombreEquipo">{{ tarea.nombreEquipo }}</div>
          <div class="lista averia">{{ tarea.averia }}</div>
          <div class="lista">{{ tarea.estado }}</div>
          <div class="lista actions">
            <button @click="toggleEstado(tarea.id_ticket)" class="btn-toggle">Cambiar estado</button>
            <button @click="eliminarTarea(tarea.id_ticket)" class="btn-delete">Eliminar</button>
          </div>
        </div>
      </div> -->
    </div>
    <div class="task-input">
      <br>
      <input v-model="nuevaTarea" placeholder="Añadir nueva tarea" />
      <button @click="agregarTarea" class="btn-add">Agregar</button>
    </div>
  </div>


</template>

<script>
import axios from "axios";
import DataTable from "../shared/DataTable.vue";
export default {
  components: {
    DataTable
  },
  data() {
    return {
      tareas: [],
      nuevaTarea: "",
      headers: {
        id_ticket: "Nº ticket",
        fecha: "Fecha",
        equipoId: "Nº Equipo",
        nombreEquipo: "Nombre Equipo",
        averia: "Avería",
        estado: "Estado",
      },

    };
  },
  mounted() {

    axios
      .get("http://localhost/BDD-MedicalEquipment/controller/tickets/getTicketsByID.php?usuario_id=" + localStorage.getItem("usuario_id"))
      .then((response) => {
        // Asignamos los datos transformados a tareas
        this.tareas = response.data.map(task => ({
          id_ticket: task.id_ticket,
          fecha: task.fecha_creacion,
          equipoId: task.inventario_id,
          nombreEquipo: task.nombre_modelo,
          averia: task.descripcion,
          estado: task.estado ? "Completada" : "Pendiente"
        }));
      })
      .catch((error) => {
        console.log("Error: ", error);
      });
  },
  methods: {
    agregarTarea() {
      console.log("Agregar tarea");
    },
    toggleEstado(id) {
      const tarea = this.tareas.find((t) => t.id === id);
      if (tarea) tarea.estado = !tarea.estado;
    },
    eliminarTarea(id) {
      this.tareas = this.tareas.filter((t) => t.id !== id);
    },
  },
};
</script>

<style scoped>
.container {
  background: linear-gradient(135deg, #2c3e50, #398aa5);
  padding: 1.5rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 80%;
  margin: auto;
  margin-top: 1rem;
}

.title {
  color: #ecf0f1;
  margin-bottom: 0.625rem;
  font-size: 2rem;
  font-weight: bold;
}

button {
  padding: 0.313rem 0.625rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

</style>
