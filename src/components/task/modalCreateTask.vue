<template>
  <div class="modal">
    <div class="modal-content">
      <h2>Crear tarea</h2>

      <label for="inventario_id">Equipo:</label>
      <input v-model="nuevaTarea.inventario_id" type="text" placeholder="Ingrese el número de equipo">
      <hr>

      <label for="descripcion">Avería:</label>
      <input v-model="nuevaTarea.descripcion" type="text" placeholder="Ingrese la descripción de la avería">
      <hr>

      <label for="tecnico_id">Técnico</label>
      <select v-model="nuevaTarea.usuario_id">
        <option v-for="tecnico in tecnicos" :key="tecnico.id_usuario" :value="tecnico.id_usuario">
          {{ tecnico.id_usuario }} - {{ tecnico.nombre }} {{ tecnico.apellidos }}
        </option>
      </select>

      <div class="modal-buttons">
        <button @click="crearTarea">Guardar</button>
        <button @click="$emit('cerrarModalTask')">Cancelar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["mostrarModal"],
  data() {
    return {
      tecnicos: [],
      nuevaTarea: {
        inventario_id: "",
        descripcion: "",
        usuario_id: ""
      }
    };
  },
  mounted() {
    this.cargarTecnicos();
  },
  methods: {
    async cargarTecnicos() {
      try {
        const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/users/getAll_users.php");
        this.tecnicos = response.data;
      } catch (error) {
        console.error("Error cargando técnicos:", error);
      }
    },
    async crearTarea() {
      const { inventario_id, descripcion, usuario_id } = this.nuevaTarea;
      if (!inventario_id || !descripcion || !usuario_id) {
        alert("Todos los campos son obligatorios");
        return;
      }

      try {
        let formData = new FormData();
        formData.append("inventario_id", inventario_id);
        formData.append("descripcion", descripcion);
        formData.append("usuario_id", usuario_id);

        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/tickets/createTicket.php",
          formData,
          { headers: { "Content-Type": "multipart/form-data" } }
        );

        console.log("Tarea creada:", response.data);
        alert("Tarea creada con éxito");

        // Limpiar formulario ya que no vamos a cerrar el modal automaticamente.
        this.nuevaTarea = { inventario_id: "", descripcion: "", usuario_id: "" };
      } catch (error) {
        console.error("Error al guardar tarea:", error);
      }
    }
  }
};
</script>

  
  <style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #34495e;
  padding: 20px;
  border-radius: 10px;
  width: 500px;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  color: #ecf0f1;
}

h2 {
  font-size: 1.8rem;
  color: #1abc9c;
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #ecf0f1;
  font-size: 1rem;
}

input,
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 8px;
  border: none;
  background: #2c3e50;
  color: #ecf0f1;
  font-size: 1rem;
  box-sizing: border-box;
}

input:focus,
select:focus {
  outline: none;
  border: 2px solid #1abc9c;
}

.modal-buttons {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
}

button {
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-size: 1rem;
}

button:first-child {
  background-color: #1abc9c;
  color: white;
}

button:first-child:hover {
  background-color: #16a085;
}

button:last-child {
  background-color: #e74c3c;
  color: white;
}

button:last-child:hover {
  background-color: #c0392b;
}
</style>
  