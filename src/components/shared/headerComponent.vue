<template>
    <header class="header">
        <h2>{{text}}</h2>

        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><router-link to="/inventary" class="nav-link">Inventario</router-link></li>
                <li class="nav-item"><router-link to="/tareasList" class="nav-link">Ordenes</router-link></li>
                <li class="nav-item"><router-link to="/" class="nav-link">Almacen</router-link></li>
                <li class="nav-item"><router-link to="/" class="nav-link">Cerrar sesión</router-link></li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data() {
        return {
            text: 'Gestión de Tareas Script'
        };
    }
}

</script>

<style scoped>
.header {
    background-color: #add8e6;
    padding: 1rem;
}

.nav {
    display: flex;
    justify-content: space-around;
}

.nav-list {
    list-style: none;
    display: flex;
    gap: 1rem;
    padding: 0;
    margin: 0;
}



.nav-link {
    text-decoration: none;
    color: black;
    background-color: white;
    border: 1px solid black;
    border-radius: 5px;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s;
}

.nav-link:hover {
    background-color: #f0f0f0;
}
</style>