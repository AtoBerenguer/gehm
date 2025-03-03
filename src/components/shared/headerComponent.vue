<template>
    <header class="header">
        <h2 class="title">{{ text }}</h2>

        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <router-link to="/inventary" class="nav-link">Inventario</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/main" class="nav-link">Órdenes</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link">Almacén</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link logout">LogOut</router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
    data() {
        return {
            text: "GMHM",
        };
    },
};
</script>

<style scoped>
.header {
    background: linear-gradient(135deg, #2c3e50, #398aa5);
    padding: 1.5rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    align-items: center;
    width: 80%;
    margin: auto;
}
h2{
width: 70%;
}

.title {
    color: white;
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: bold;
}

.nav {
    width: 100%;
    display: flex;
    justify-content: center;
}

.nav-list {
    list-style: none;
    display: flex;
    gap: 1.2rem;
    padding: 0;
    margin: 0;
}

.nav-item {
    transition: transform 0.2s ease-in-out;
}

.nav-item:hover {
    transform: scale(1.1);
}

.nav-link {
    text-decoration: none;
    color: white;
    background-color: rgba(255, 255, 255, 0.2);
    border: 2px solid white;
    border-radius: 8px;
    padding: 0.6rem 1.2rem;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

.nav-link:hover {
    background-color: white;
    color: #2c3e50;
}

.logout {
    background-color: rgba(255, 0, 0, 0.6);
    border-color: white;
}

.logout:hover {
    background-color: red;
    color: white;
}
</style>
