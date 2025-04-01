<template>
    <div class="container">
        <h2 class="title">Inventario de Equipos</h2>
        <button @click="abrirModal()" class="btn-create">Crear Equipo</button>

        <DataTable :data="equipos" 
        :headers="headers" 
        :itemsPerPage="15" 
        @objetoSeleccionado="abrirModalEquipo" /> 

        <modalCreateEquipment 
        v-if="mostrarModal" 
        @cerrarModal="cerrarModal" />
        
        <modalEquipoSeleccionado 
        v-if="mostrarModalEquipo" 
        :equipo="equipoSelecionado" 
        @cerrarModal="cerrarModalEquipo" />

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
            mostrarModal: false,
            mostrarModalEquipo: false,
            equipoSelecionado: null,
            headers: {
                id_inventario: "ID",
                nombre_categoria: "Categoria",
                nombre_marca: "Marca",
                nombre_modelo: "Modelo",
                numero_serie: "Número de Serie",
                estado: "Estado",
            
            },
        };
    },
    mounted() { 
        // cargamos los equipos al cargar el componente
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
