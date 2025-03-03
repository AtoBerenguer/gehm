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

</style>

