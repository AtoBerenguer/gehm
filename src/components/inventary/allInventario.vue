<template>
    <div class="container">
        <h2 class="title">Inventario de Equipos</h2>

        <button @click="abrirModal()" class="btn-create">Crear Equipo</button>

        <div class="table-container">
            <div class="table-header">
                <div class="table-cell">ID</div>
                <div class="table-cell">Categoría</div>
                <div class="table-cell">Marca</div>
                <div class="table-cell">Modelo</div>
                <div class="table-cell">Número de Serie</div>
                <div class="table-cell">Estado</div>
            </div>
            <div v-for="equipo in equipos" :key="equipo.id_inventario" class="table-row" @click="abrirModalEquipo(equipo)">
                <div class="table-cell">{{ equipo.id_inventario }}</div>
                <div class="table-cell categoria">{{ equipo.nombre_categoria }}</div>
                <div class="table-cell">{{ equipo.nombre_marca }}</div>
                <div class="table-cell">{{ equipo.nombre_modelo }}</div>
                <div class="table-cell">{{ equipo.numero_serie }}</div>
                <div class="table-cell">{{ equipo.estado }}</div>
            </div>
        </div>

        <modalCreateEquipment v-if="mostrarModal" @cerrarModal="cerrarModal" />
        <modalEquipoSeleccionado v-if="mostrarModalEquipo" :equipo="equipoSelecionado" @cerrarModal="cerrarModalEquipo" />
    </div>
</template>

<script>
import axios from 'axios';
import modalCreateEquipment from './modalCreateEquipment.vue';
import modalEquipoSeleccionado from './modalEquipoSeleccionado.vue';
export default {
    
    components: {
        modalCreateEquipment,
        modalEquipoSeleccionado
    },
    data() {
        return {
            equipos: [],
            mostrarModal: false,
            mostrarModalEquipo: false,
            equipoSelecionado: null
        };
    },
    mounted() { // cargamos los equipos al cargar el componente
        axios.get('http://localhost/BDD-MedicalEquipment/controller/inventary/CRUD_INVENTARY.php')
            .then(response => {
                this.equipos = response.data;
                
            })
            .catch(error => {
                console.log("Error: ", error);
            });
    },
    methods: {
        abrirModal() {
            this.mostrarModal = true;
        },
        cerrarModal() {
            this.mostrarModal = false;
            window.location.reload();
        },
        abrirModalEquipo(equipo) { // funcion para abrir el modal con la información del equipo seleccionado
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
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 80%;
    margin: auto;
    margin-top: 20px;
}

.title {
    color: white;
    font-size: 2rem;
    margin-bottom: 1rem;
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
}

button:hover {
    background-color: #16a085;
    transform: scale(1.05);
}

.table-container {
    width: 100%;
    max-width: 70%;
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.table-header,
.table-row {
    display: flex;
    background-color: #1abc9c;
    color: white;
    font-weight: bold;
}

.table-row:nth-child(even) {
    background-color: #34495e;
}

.table-row:nth-child(odd) {
    background-color: #2f3c4a;
}

.table-row:hover {
    background-color: #1abc9c;
    color: white;
}

.table-cell {
    flex: 1;
    padding: 0.3rem;
    font-size: smaller;
    
    max-height: 1.5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #ecf0f1;
    text-align: center;
}
.categoria {
text-align: left;}

.table-cell:last-child {
    border-right: none;
}
</style>
