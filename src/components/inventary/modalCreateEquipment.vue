<template>
    <div class="modal">
        <div class="modal-content">
            <h2>Crear equipo</h2>

            <label>Número de Serie:</label>
            <input v-model="nuevoEquipo.numero_serie" type="text">
            <hr>
            <label>Categoría:</label>
            <select v-model="nuevoEquipo.categoria_id">
                <option v-for="categoria in categorias" :key="categoria.id_categoria" :value="categoria.id_categoria">
                    {{ categoria.id_categoria }} {{ categoria.nombre_categoria }}
                </option>
            </select>
            <hr>
            <label>Modelo:</label>
            <select v-model="nuevoEquipo.modelo_id">
                <option v-for="modelo in modelos" :key="modelo.id_modelo" :value="modelo.id_modelo">
                    {{ modelo.nombre_modelo }}
                </option>
            </select>

            <div class="modal-buttons">
                <button @click="guardarEquipo">Guardar</button>
                <button @click="$emit('cerrarModal')">Cancelar</button>
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
            nuevoEquipo: {
                numero_serie: "",
                categoria_id: "",
                modelo_id: ""
            },
            categorias: [],
            modelos: []
        };
    },
    mounted() {
        this.cargarCategorias();
        this.cargarModelos();
    },
    methods: {

        async cargarCategorias() {
            const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/categories/getAllCategories.php");
            this.categorias = response.data;
            

        },
        async cargarModelos() {
            const response = await axios.get("http://localhost/BDD-MedicalEquipment/controller/models/getAllModels.php");
            this.modelos = response.data;

        },
        async guardarEquipo() {
            try {
                let formData = new FormData();
                formData.append("categoria_id", this.nuevoEquipo.categoria_id);
                formData.append("modelo_id", this.nuevoEquipo.modelo_id);
                formData.append("numero_serie", this.nuevoEquipo.numero_serie);

                const response = await axios.post(
                    "http://localhost/BDD-MedicalEquipment/controller/inventary/create_equipment.php",
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );

                console.log(response.data); // Verifica la respuesta del servidor
                alert("Equipo agregado correctamente");
                this.$emit("cerrarModal"); // Cierra el modal
            } catch (error) {
                console.error("Error al guardar el equipo:", error);
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
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    text-align: center;
}

.modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}


</style>