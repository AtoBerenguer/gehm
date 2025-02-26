<template>
    <div>
        <HeaderComponent></HeaderComponent>

        <header>
            <h1>Gestión de Tareas</h1>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tarea</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tarea in tareas" :key="tarea.id">
                        <td>{{ tarea.id }}</td>
                        <td>{{ tarea.nombre }}</td>
                        <td>{{ tarea.estado }}</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</template>

<script>
import HeaderComponent from './shared/headerComponent.vue';

export default {
    name: 'MainContent',
    components: {
        HeaderComponent
    },
    data() {
        return {
            tareas: [
                { id: 1, nombre: 'Tarea 1', estado: 'Pendiente' },
                { id: 2, nombre: 'Tarea 2', estado: 'En Progreso' },
                { id: 3, nombre: 'Tarea 3', estado: 'Completada' }
            ]
        };
    }
};
</script>

<style scoped>
header {
    background-color: #f8f9fa;
    padding: 1rem;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
}

th, td {
    border: 1px solid #dee2e6;
    padding: 0.75rem;
    text-align: left;
}

th {
    background-color: #e9ecef;
}
</style>

