<template>
    <div>
        <tareasList />
                
    </div>
</template>

<script>
import tareasList from './task/tareasList.vue';

export default {
    name: 'MainContent',
    components: {
       tareasList,
        
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

</style>

