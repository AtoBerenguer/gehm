<template>
    <headerComponent></headerComponent>
    <div class="container">
        <h2 class="title">Inventario de Equipos</h2>
        
        <button @click="mostrarModal = true" class="btn-create">Crear Equipo</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipología</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="equipo in equipos" :key="equipo.id">
                    <td>{{ equipo.id_inventario }}</td>
                    <td>{{ equipo.nombre_categoria }}</td>
                    <td>{{ equipo.nombre_marca }}</td>
                    <td>{{ equipo.nombre_modelo }}</td>
                    <td>{{ equipo.numero_serie }}</td>
                </tr>
            </tbody>
        </table>
        <modalCreateEquipment v-if="mostrarModal" @cerrarModal="cerrarModal"/>
    </div>
</template>

<script>
import headerComponent from '../shared/headerComponent.vue'
import axios from 'axios'
import modalCreateEquipment from './modalCreateEquipment.vue'

export default {
    name: 'allInventario',
    components: {
        headerComponent,
        modalCreateEquipment
    },
    data() {
        return {
            equipos: [],
            mostrarModal: false,
        };
    },
    mounted() {
        axios.get('http://localhost/BDD-MedicalEquipment/controller/inventary/CRUD_INVENTARY.php').then(response => {
            this.equipos = response.data;
            console.log(this.equipos);
        }).catch(error => {
            console.log("Error: ", error);
        });
    },
    methods: {
        abrirModal() {
            this.mostrarModal = true;
        },
        cerrarModal() {
            this.mostrarModal = false;
        }
    }
}
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 10px;
    text-align: left;
    color: #ecf0f1;
}

th {
    background-color: #1abc9c;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #34495e;
}

tr:nth-child(odd) {
    background-color: #2f3c4a;
}

tr:hover {
    background-color: #1abc9c;
    color: white;
}

.btn-create {
    background: #16a085;
}

.btn-create:hover {
    background-color: #1abc9c;
}
</style>
