<template>
    <div class="container">
        <h2 class="title">Inventario de Equipos</h2>
        <button v-if="rolId == '1'" @click="abrirModal()" class="btn-create">Crear Equipo</button>

        <!-- Filtros por columna -->
        <div class="filters">
            <input v-for="(label, key) in headers" :key="key" v-model="filters[key]" :placeholder="`Filtrar por ${label}`" class="filter-input" />
        </div>

        <!-- Tabla con datos filtrados -->
        <DataTable 
            :data="filteredEquipos" 
            :headers="headers" 
            :itemsPerPage="15" 
            @objetoSeleccionado="abrirModalEquipo" 
        />

        <modalCreateEquipment v-if="mostrarModal" @cerrarModal="cerrarModal" />
        <modalEquipoSeleccionado v-if="mostrarModalEquipo" :equipo="equipoSelecionado" @cerrarModal="cerrarModalEquipo" />
    </div>
</template>

<script>
import DataTable from '../shared/DataTable.vue';
import axios from 'axios';
import modalCreateEquipment from './modalCreateEquipment.vue';
import modalEquipoSeleccionado from './modalEquipoSeleccionado.vue';

export default {
    components: {
        modalCreateEquipment,
        modalEquipoSeleccionado,
        DataTable
    },
    data() {
        return {
            equipos: [],
            rolId: '',
            mostrarModal: false,
            mostrarModalEquipo: false,
            equipoSelecionado: null,
            filters: {}, // Almacena los filtros por columna
            headers: {
                id_inventario: "ID",
                nombre_categoria: "Categoria",
                nombre_marca: "Marca",
                nombre_modelo: "Modelo",
                numero_serie: "Número de Serie",
                estado: "Estado",
            }
        };
    },
    computed: {
        filteredEquipos() {
            return this.equipos.filter(equipo => {
                return Object.keys(this.filters).every(key => {
                    const filterValue = this.filters[key]?.toLowerCase() || "";
                    return filterValue === "" || String(equipo[key]).toLowerCase().includes(filterValue);
                });
            });
        }
    },
    mounted() { 
        this.rolId = localStorage.getItem("rol_id");

        axios.get('http://localhost/BDD-MedicalEquipment/controller/inventary/CRUD_INVENTARY.php')
            .then(response => {
                this.equipos = response.data;
            })
            .catch(error => {
                console.log("Error: ", error);
            });
        this.rolId = localStorage.getItem("rol_id");

    },
    methods: {
        abrirModal() {
            this.mostrarModal = true;
        },
        cerrarModal() {
            this.mostrarModal = false;
            window.location.reload();
        },
        abrirModalEquipo(equipo) { 
            this.equipoSelecionado = equipo;
            this.mostrarModalEquipo = true;
        },
        cerrarModalEquipo() {
            this.mostrarModalEquipo = false;
            this.equipoSelecionado = null;
            window.location.reload();
        }
    }
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
    color: white;
    font-size: 2rem;
    margin-bottom: 1rem;
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
}

button:hover {
    background-color: #16a085;
    transform: scale(1.05);
}
</style>
