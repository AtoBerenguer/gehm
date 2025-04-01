<template>
  <div class="container">

    <div class="listaTareas">
      <h2 class="title">Lista de Tareas</h2>
      <div class="task-input">
        <button class="btnMod" @click="abrirModalTask()" v-if="rolId !== '3'">Agregar</button>
        <button class="btnMod" v-if="rolId !== '3'" @click="cargarTodasOT">Cargar todas la tareas</button>
      </div>
      <DataTable :data="tareas" 
      :headers="headers" 
      :itemsPerPage="15" />

      <modalCreateTask v-if="mostrarModal" @cerrarModalTask="cerrarModalTask" />
      <modalTaskSelect v-if="mostrarModalTask" :tarea="tareaSeleccionada" ></modalTaskSelect>
    </div>
  </div>


</template>

<script>
import axios from "axios";
import DataTable from "../shared/DataTable.vue";
import modalCreateTask from "./modalCreateTask.vue";
import modalTaskSelect from "./modalTaskSelect.vue";

export default {
  components: {
    DataTable,
    modalCreateTask,
    modalTaskSelect,
  },
  data() {
    return {
      tareas: [],
      rolId: null,
      nuevaTarea: "",
      mostrarModal: false,
      mostrarModalTask: false,
      tareaSeleccionada: null,
      headers: {
        id_ticket: "Nº ticket",
        fecha: "Fecha",
        equipoId: "Nº Equipo",
        nombre_categoria: "Tipologia",
        nombreModelo: "Nombre Modelo",
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
        this.tareas = response.data.map(task => ({
          id_ticket: task.id_ticket,
          fecha: task.fecha_creacion,
          equipoId: task.inventario_id,
          nombreModelo: task.nombre_modelo,
          averia: task.descripcion,
          estado: task.estado ? "Completada" : "Pendiente",
          nombre_categoria: task.nombre_categoria
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
    
    cargarTodasOT() {
      axios
        .get("http://localhost/BDD-MedicalEquipment/controller/tickets/getAllTickets.php")
        .then((response) => {
          this.tareas = response.data.map(task => ({
            id_ticket: task.id_ticket,
            fecha: task.fecha_creacion,
            equipoId: task.inventario_id,
            nombreModelo: task.nombre_modelo,
            averia: task.descripcion,
            estado: task.estado,
            nombre_categoria: task.nombre_categoria
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
button {
    background: #1abc9c;
    color: white;
    border: none;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    margin-bottom: 1rem;
    margin-left: 1rem;
}

button:hover {
    background-color: #16a085;
    transform: scale(1.05);
}

</style>
