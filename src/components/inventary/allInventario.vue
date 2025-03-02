<template>
    <headerComponent></headerComponent>
    <div>
        <h2>Inventario de Equipos</h2>
        
        <button @click="mostrarModal = true">Crear Equipo</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipologia</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Número de Serie</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="equipo in equipos" :key="equipo.id">
                    <td>{{ equipo.id_inventario }}</td>
                    <td>{{ equipo.nombre_categoria}}</td>
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
            mostrarModal:false,
        }
    },
    mounted() {
        axios.get('http://localhost/BDD-MedicalEquipment/controller/inventary/CRUD_INVENTARY.php').then(response => {
            this.equipos = response.data;
            console.log(this.equipos);
        }).catch(error => {
            console.log("Error: ", error);
        });
    },
    methods:{
        abrirModal(){
            this.mostrarModal = true;
        },
        cerrarModal(){
            this.mostrarModal = false;
        }
    }
}

</script>

<style scoped>
    table{
        width: 100%;
        border-collapse: collapse;
    }
    th, td{
        padding: 10px;
        border: 1px solid #ddd;

    }
    th{
        background-color: #f2f2f2;
        color: black;
    }
    
</style>