<template>
  <div class="container">
    <div class="listaTareas">
      <h2>Lista de Tareas</h2>
      <div class="containerLista">
        <div class="lista-titulos">
          <div class="lista titulo">Fecha</div>
          <div class="lista titulo">Num Ot</div>
          <div class="lista titulo">Equipo</div>
          <div class="lista titulo">Nombre Equipo</div>
          <div class="lista titulo">Avería</div>
          <div class="lista titulo">Estado</div>
          <div class="lista titulo">Acciones</div>
        </div>
        <div v-for="(tarea, index) in tareas" :key="tarea.id" :class="['lista-fila', index % 2 === 0 ? 'par' : 'impar']">
          <div class="lista">{{ tarea.numOt }}</div>
          <div class="lista">{{ tarea.fecha }}</div>
          <div class="lista">{{ tarea.equipoId }}</div>
          <div class="lista nombreEquipo" >{{ tarea.nombreEquipo }}</div>
          <div class="lista averia">{{ tarea.averia }}</div>
          <div class="lista">{{ tarea.estado ? 'Completada' : 'Pendiente' }}</div>
          <div class="lista actions">
            <button @click="toggleEstado(tarea.id)" class="btn-toggle">Cambiar estado</button>
            <button @click="eliminarTarea(tarea.id)" class="btn-delete">Eliminar</button>
          </div>
        </div>
      </div>
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
        { id: 1, numOt: 1, fecha: "02/03/2025", equipoId: 2, 
        nombreEquipo: "Electrocardiografo", averia: "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", estado: false },
        { id: 2, numOt: 2, fecha: "02/03/2025", equipoId: 2, 
        nombreEquipo: "Electrocardiografo", averia: "El equipo no imprime y salen artefactos", estado: false },
        { id: 3, numOt: 3, fecha: "02/03/2025", equipoId: 2, 
        nombreEquipo: "Electrocardiografo", averia: "El equipo no imprime y salen artefactos", estado: false },
        { id: 4, numOt: 4, fecha: "02/03/2025", equipoId: 2, 
        nombreEquipo: "ElectrocardiografoTocoojhasdihjasdoahsdoasd", averia: "El equipo no imprime y salen artefactos", estado: false },
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
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.nombreEquipo {
  width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
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
.listaTareas {
  border-radius: 12px;
  text-align: center;
  width: 80%;
}
h2 {
  color: #ecf0f1;
  margin-bottom: 0.625rem;
  font-size: 2rem;
  font-weight: bold;
}
.containerLista {
    width:100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    border-radius: 0.625rem;
    overflow: hidden;
}
.lista-titulos, .lista-fila {
  display: grid;
  gap: 1rem;
  grid-template-columns: 3rem 5rem 3rem 10rem 2fr 6rem 1fr;
 
}

.lista-titulos{
  background: #16a085;
  color: white;
}

.lista {
  flex: 1;
  padding: 0.3rem;
  text-align: center;
  color: #ecf0f1;
  margin: auto;
}
.titulo {
  font-weight: bold;
  height: 1.5rem;
}
.actions {
  display: flex;
  gap: 0.625rem;
  padding: 0.4rem;
}
.par {
  background: #3b4b5a;
}
.impar {
  background: #2f3c4a;
}
.list-row:hover {
  background-color: #1abc2a70;
  color: white;
}
button {
  padding: 0.313rem 0.625rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
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
