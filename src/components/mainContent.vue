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
    
};
</script>

<style scoped>

</style>

