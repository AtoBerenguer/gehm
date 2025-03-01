<template>
    <div>
        <h2>Inventario de Equipos</h2>
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
                    <td>{{ equipo.id }}</td>
                    <td>{{ equipo.tipologia }}</td>
                    <td>{{ equipo.marca }}</td>
                    <td>{{ equipo.modelo }}</td>
                    <td>{{ equipo.numeroSerie }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'allInventario',
    data() {
        return {
            equipos: []
        }
    },
    mounted() {
        axios.get('/equipos.json').then(response => {
            this.equipos = response.data;
            console.log(this.equipos);
        });
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
    }
    
</style>