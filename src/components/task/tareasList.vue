<template>
  <div class="container">

    <div class="listaTareas">
      <h2 class="title">Lista de Tareas</h2>
      <div class="task-input">
        <button @click="abrirModalTask()" v-if="rolId !== '3'">Agregar</button>
        <button v-if="rolId !== '3'" @click="cargarTodasOT">Cargar todas la tareas</button>
      </div>
      <DataTable :data="tareas" 
      :headers="headers" 
      :itemsPerPage="15" />

      <modalCreateTask v-if="mostrarModal" @cerrarModalTask="cerrarModalTask" />
    </div>
  </div>


</template>

<script>
import axios from "axios";
import DataTable from "../shared/DataTable.vue";
import modalCreateTask from "./modalCreateTask.vue";

export default {
  components: {
    DataTable,
    modalCreateTask,
  },
  data() {
    return {
      tareas: [],
      rolId: null,
      nuevaTarea: "",
      mostrarModal: false,
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
    this.rolId = localStorage.getItem("rol_id");

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
    cargarTodasOT() {
      axios
        .get("http://localhost/BDD-MedicalEquipment/controller/tickets/getAllTickets.php")
        .then((response) => {
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
    abrirModalTask() {
      this.mostrarModal = true;
    },
    cerrarModalTask(){
      this.mostrarModal = false;
    }
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


</style>
