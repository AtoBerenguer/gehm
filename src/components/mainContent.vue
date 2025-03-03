<template>
    <div>
        <HeaderComponent></HeaderComponent>
        <tareasList />
        <FooterComponent></FooterComponent>
        
    </div>
</template>

<script>
import HeaderComponent from './shared/headerComponent.vue';
import tareasList from './task/tareasList.vue';
import FooterComponent from './shared/footerComponent.vue';

export default {
    name: 'MainContent',
    components: {
        HeaderComponent,
        tareasList,
        FooterComponent
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

