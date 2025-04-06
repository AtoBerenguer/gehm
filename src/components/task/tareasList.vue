<template>
  <div class="container">
    <div class="listaTareas">
      <h2 class="title">Lista de Tareas</h2>

      <div class="task-input">
        <button class="btnMod" @click="abrirModalTask()" v-if="rolId !== '3'">Agregar</button>
      </div>

      <div class="filters">
        <div v-for="(label, key) in headers" :key="key">
          <div v-if="key !== 'estado'"> 
            <!-- creamos un condicional para eliminar estado de la creacion de filtros ya que lo manejamos de una manera diferente -->
            <input v-model="filters[key]" :placeholder="`Filtrar por ${label}`" class="filter-input" />
          </div>
        </div>

        <div class="filters">
          <select v-model="estadoFiltro" class="filter-input">
            <option value="Pendiente">Mostrar solo Pendientes</option>
            <option value="Finalizada">Mostrar solo Finalizadas</option>
            <option value="Todas">Mostrar todo</option>
          </select>
        </div>
      </div>


      <DataTable :data="filteredTareas" :headers="headers" :itemsPerPage="15"
        @objetoSeleccionado="abrirModalTaskSelect" />

      <modalCreateTask v-if="mostrarModal" @cerrarModalTask="cerrarModalTask" />

      <modalTaskSelect v-if="mostrarModalTask" :tarea="tareaSeleccionada"
        @cerrarModalTareaSelect="cerrarModalTareaSelect" />
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
      mostrarModal: false,
      mostrarModalTask: false,
      tareaSeleccionada: null,
      estadoFiltro: 'Pendiente',
      filters: {},
      headers: {
        id_ticket: "Nº ticket",
        fecha: "Fecha",
        equipoId: "Nº Equipo",
        nombre_categoria: "Tipología",
        nombreModelo: "Nombre Modelo",
        averia: "Avería",
        estado: "Estado",
      },
    };
  },
  computed: {
    filteredTareas() {
      return this.tareas
        .filter(t => {

          if (this.estadoFiltro === 'Todas') return true;
          return t.estado === this.estadoFiltro;
        })
        .filter(tarea => {

          return Object.keys(this.filters).every(key => {
            const filterValue = this.filters[key]?.toLowerCase() || "";
            return filterValue === "" || String(tarea[key]).toLowerCase().includes(filterValue);
          });
        });
    }
  },
  mounted() {

    this.rolId = localStorage.getItem("rol_id");

    if (this.rolId === '1' || this.rolId === '2') {
      this.cargarTodasOT();
    } else if (this.rolId === '3') {
      this.cargarTareasPorUsuario();
    }


  },
  methods: {
    cargarTodasOT() {
      axios
        .get("http://localhost/BDD-MedicalEquipment/controller/tickets/getAllTickets.php")
        .then(response => {
          this.tareas = response.data.map(task => ({
            id_ticket: task.id_ticket,
            fecha: task.fecha_creacion,
            equipoId: task.inventario_id,
            nombreModelo: task.nombre_modelo,
            averia: task.descripcion,
            estado: task.estado,
            nombre_categoria: task.nombre_categoria,
            comentario: task.comentario
          }));
        })
        .catch(error => {
          console.log("Error: ", error);
        });
    },
    cargarTareasPorUsuario() {
      axios
        .get("http://localhost/BDD-MedicalEquipment/controller/tickets/getTicketsByID.php?usuario_id=" + localStorage.getItem("usuario_id"))
        .then(response => {
          this.tareas = response.data.map(task => ({
            id_ticket: task.id_ticket,
            fecha: task.fecha_creacion,
            equipoId: task.inventario_id,
            nombreModelo: task.nombre_modelo,
            averia: task.descripcion,
            estado: task.estado,
            nombre_categoria: task.nombre_categoria,
            comentario: task.comentario
          }));
        })
        .catch(error => {
          console.log("Error: ", error);
        });
    },

    abrirModalTask() {
      this.mostrarModal = true;
    },
    cerrarModalTask() {
      this.mostrarModal = false;
      window.location.reload();

    },
    abrirModalTaskSelect(tarea) {
      this.tareaSeleccionada = tarea;
      this.mostrarModalTask = true;

    },
    cerrarModalTareaSelect() {
      this.mostrarModalTask = false;
      this.tareaSeleccionada = null;
      window.location.reload();

    },
  },
};
</script>


<style scoped>
.container {
    background: linear-gradient(135deg, #2c3e50, #398aa5);
    padding: 1.5rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 80%;
    margin: auto;
    margin-top: 20px;
    border-radius: 10px;
}

.title {
  color: #ecf0f1;
  margin-bottom: 0.625rem;
  font-size: 2rem;
  font-weight: bold;
}

.filters {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 10px;
}

.filter-input {
  padding: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 200px;
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
