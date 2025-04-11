<template>
  <div class="modal">
    <div class="modal-content">
      <select v-model="opcionSeleccionada" @change="cambiarOpcion">
        <option value="equipo">Crear Equipo</option>
        <option value="categoria">Crear Categoria</option>
        <option value="marca">Crear Marca</option>
        <option value="modelo">Crear Modelo</option>
        
      </select>


      <div v-if="opcionSeleccionada === 'equipo'">
        <form @submit.prevent="guardarEquipo">
        <h2>Crear equipo</h2>


        <label for="numero_serie">Número de Serie:</label>
        <input v-model="nuevoEquipo.numero_serie" type="text" placeholder="Ingrese el número de serie">

        <hr>


        <label for="categoria_id">Categoría:</label>
        <select v-model="nuevoEquipo.categoria_id" @change="cargarModelos">
          <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">
            {{ categoria.id_categoria }} - {{ categoria.nombre_categoria }}
          </option>
        </select>

        <hr>


        <label for="modelo_id">Modelo:</label>
        <select v-model="nuevoEquipo.modelo_id" :disabled="!nuevoEquipo.categoria_id">
          <option v-for="modelo in modelos" :key="modelo.id_modelo" :value="modelo.id_modelo">
            {{ modelo.nombre_modelo }}
          </option>
        </select>
        <p v-if="errorEquipo" class="error-text">{{ errorEquipo }}</p>
        <hr>
        <button class="guardarBtn" type="submit">Guardar</button>

      </form>
      </div>
      
      <div v-if="opcionSeleccionada === 'marca'">
        <form @submit.prevent="guardarMarca">
        <h2>Crear Marca</h2>


        <label for="numero_serie">Marca:</label>
        <input v-model="marca" type="text" placeholder="Ingrese el nombre de la Marca">
        <p v-if="errorMarca" class="error-text">{{ errorMarca }}</p>
        <hr>

        <button class="guardarBtn" type="submit">Guardar</button>

      </form>
      </div>
      <div v-if="opcionSeleccionada === 'modelo'">
        <form @submit.prevent="guardarModelo">
        <h2>Crear Modelo</h2>


        <label for="nombre_modelo">Nombre modelo:</label>
        <input v-model="nuevoModelo.nombre_modelo" type="text" placeholder="Ingrese el modelo">

        <hr>


        <label for="marca">Marcas:</label>
        <select v-model="nuevoModelo.marca_id">
          <option v-for="marca in marcas" :key="marca.id_marca" :value="marca.id_marca">
            {{ marca.id_marca }} - {{ marca.nombre_marca }}
          </option>
        </select>

        <hr>

        <label for="categoria_id">Categoría:</label>
        <select v-model="nuevoModelo.categoria_id">
          <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">
            {{ categoria.id_categoria }} - {{ categoria.nombre_categoria }}
          </option>
        </select>
        <hr>
        <p v-if="errorModelo" class="error-text">{{ errorModelo }}</p>

        <button class="guardarBtn" type="submit">Guardar</button>

      </form>
      </div>

      <div v-if="opcionSeleccionada === 'categoria'">
        <form @submit.prevent="guardarCategoria">
        <h2>Crear Categoria</h2>


        <label for="numero_serie">Categoria:</label>
        <input v-model="categoria" type="text" placeholder="Ingrese el nombre de la categoria">
        <p v-if="errorCategoria" class="error-text">{{ errorCategoria }}</p>

        <hr>

        <button class="guardarBtn" type="submit">Guardar</button>
      </form>

      </div>

      <div class="modal-buttons">
        <button class="closeBtn" @click="$emit('cerrarModal')">Cancelar</button>
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
      opcionSeleccionada: "equipo", 
      nuevoEquipo: {
        numero_serie: "",
        categoria_id: "",
        modelo_id: ""
      },
      marca: "",
      modelo: "",
      categoria: "",
      categorias: [],
      modelos: [],
      marcas: [],
      nuevoModelo: {
        nombre_modelo: "",
        marca_id: "",
        categoria_id: ""
      },
      errorMarca: "",
      errorCategoria: "",
      errorModelo: "",
      errorEquipo: ""
    };
  },
  mounted() {
    this.cargarCategorias();
    this.cargarMarcas();
  },
  methods: {
    async cargarCategorias() {
      const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/categories/getAllCategories.php");
      this.categorias = response.data;
    },
    async cargarModelos() {
      if (!this.nuevoEquipo.categoria_id) return;
      const response = await axios.get(
        `http://localhost/BDD-MedicalEquipment/controller/models/getModelByCategory.php?categoria_id=${this.nuevoEquipo.categoria_id}`
      );
      this.modelos = response.data;
      this.nuevoEquipo.modelo_id = "";
    },
    async cargarMarcas() {
      const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/brands/getBrands.php");
      this.marcas = response.data;
      

    },

    async guardarEquipo() {
      this.errorEquipo = ""; // Reset error message
      const { numero_serie, categoria_id, modelo_id } = this.nuevoEquipo;
      if (!numero_serie || !categoria_id || !modelo_id) {
       this.errorEquipo = "Todos los campos son obligatorios.";
        return;
      }

      try {
        
        let formData = new FormData();
        formData.append("categoria_id", categoria_id);
        formData.append("modelo_id", modelo_id);
        formData.append("numero_serie", numero_serie);

        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/inventary/create_equipment.php",
          formData,
          {
            headers: { 
              "Content-Type": "multipart/form-data"
            }
          }
        );

        console.log(response.data);
        this.$emit("cerrarModal");
      } catch (error) {
        console.error("Error al guardar el equipo:", error);
      }
    },

    async guardarMarca() {
      this.errorMarca = ""; // Reset error message
      if (!this.marca) {
        this.errorMarca ="El campo Marca es obligatorio.";
        return;
      }

      try {
        let formData = new FormData();
        formData.append("nombre_marca", this.marca);

        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/brands/CRUDBRAND.php",
          formData,
          {
            headers: { 
              "Content-Type": "multipart/form-data"
            }
          }
        );

        console.log(response.data);
        // alert("Marca agregada correctamente");
      } catch (error) {
        console.error("Error al guardar la marca:", error);
      }

    },
    async guardarCategoria() {
      this.errorCategoria = ""; // Reset error message
      if (!this.categoria) {
        this.errorCategoria ="El campo categoria es obligatorio.";
          return;
      }

      try {
        let formData = new FormData();
        formData.append("nombre_categoria", this.categoria);

        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/categories/postCategory.php",
          formData,
          {
            headers: { 
              "Content-Type": "multipart/form-data"
            }
          }
        );

        console.log(response.data);
        // alert("Categoria agregada correctamente");
      } catch (error) {
        console.error("Error al guardar la categoria:", error);
      }

    },
    async guardarModelo() {
      this.errorModelo = ""; // Reset error message
      const { nombre_modelo, marca_id, categoria_id } = this.nuevoModelo;
      if (!nombre_modelo || !marca_id || !categoria_id) {
        this.errorModelo="Todos los campos son obligatorios.";
        return;
      }

      try {
        let formData = new FormData();
        formData.append("nombre_modelo", nombre_modelo);
        formData.append("marca_id", marca_id);
        formData.append("categoria_id", categoria_id);

        const response = await axios.post(
          "http://localhost/BDD-MedicalEquipment/controller/models/createModel.php",
          formData,
          {
            headers: { 
              "Content-Type": "multipart/form-data"
            }
          }
        );

        console.log(response.data);
        // alert("Modelo agregado correctamente");
      } catch (error) {
        console.error("Error al guardar el modelo:", error);
      }

    },
  }
};
</script>

<style scoped>
.error-text {
  color: red;
  font-size: 0.9rem;
  margin-top: 4px;
}

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

.guardarBtn {
  background-color: #1abc9c;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-size: 1rem;
}

.closeBtn {
  padding: 10px 20px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  background-color: red;
  color: white;
}
</style>
