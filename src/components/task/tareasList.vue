<template>
  <div class="container">
    <div class="task-list">
      <h2>Lista de Tareas</h2>
      <table>
        <thead>
          <tr>
            <th>Num Ot</th>
            <th>Fecha</th>
            <th>Equipo</th>
            <th>Nombre Equipo</th>
            <th>Avería</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(tarea, index) in tareas" :key="tarea.id" :class="index % 2 === 0 ? 'par' : 'impar'">
            <td class="numOt">{{ tarea.numOt }}</td>
            <td>{{ tarea.fecha }}</td>
            <td>{{ tarea.equipoId }}</td>
            <td>{{ tarea.nombreEquipo }}</td>
            <td class="averia">{{ tarea.averia }}</td>
            <td>{{ tarea.estado ? 'Completada' : 'Pendiente' }}</td>
            <td>
              <button @click="toggleEstado(tarea.id)" class="btn-toggle">Cambiar estado</button>
              <button @click="eliminarTarea(tarea.id)" class="btn-delete">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="task-input">
        <input v-model="nuevaTarea" placeholder="Añadir nueva tarea" />
        <button @click="agregarTarea" class="btn-add">Agregar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nuevaTarea: "",
      tareas: [
        { id: 1, numOt: 1, fecha: "02/03/2025", equipoId: 2, nombreEquipo: "Electrocardiografo", averia: "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", estado: false },
        { id: 2, numOt: 2, fecha: "02/03/2025", equipoId: 2, nombreEquipo: "Electrocardiografo", averia: "El equipo no imprime y salen artefactos", estado: false },
        { id: 3, numOt: 3, fecha: "02/03/2025", equipoId: 2, nombreEquipo: "Electrocardiografo", averia: "El equipo no imprime y salen artefactos", estado: false },
        { id: 4, numOt: 4, fecha: "02/03/2025", equipoId: 2, nombreEquipo: "ElectrocardiografoTocoojhasdihjasdoahsdoasd", averia: "El equipo no imprime y salen artefactos", estado: false },
      ],
    };
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
.averia {
  max-width: 25rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.action {
  width: 1px;
}

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

.task-list {
  padding: 20px;
  border-radius: 12px;
  text-align: center;
}

h2 {
  color: #ecf0f1;
  margin-bottom: 10px;
  font-size: 2rem;
  font-weight: bold;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
  border-radius: 8px;
  overflow: hidden;
}

th,
td {
  padding: 12px;
  text-align: left;
  color: #ecf0f1;
}

th {
  background: #1abc9c;
  font-weight: bold;

}

td {
  max-width: 15rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.par {
  background: #3b4b5a;
}

.impar {
  background: #2f3c4a;
}

tr:hover {
  background-color: #1abc2a70;
  color: white;
}

button {
  padding: 5px 10px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  margin: 5px;
  transition: all 0.3s ease-in-out;
}

button:hover {
  opacity: 0.8;
}

.btn-toggle {
  background: #16a085;
  color: white;
}

.btn-delete {
  background: #e74c3c;
  color: white;
}

.btn-add {
  background: #1abc9c;
  color: white;
  padding: 0.6rem 1.2rem;
  border-radius: 8px;
  font-weight: bold;
  transition: all 0.3s ease-in-out;
  margin-left: 10px;
}

.task-input {
  margin-top: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
}

input {
  padding: 8px;
  width: 70%;
  border: none;
  border-radius: 5px;
  margin-right: 10px;
}

input:focus {
  outline: none;
  border: 2px solid #16a085;
}
</style>