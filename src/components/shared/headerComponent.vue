<template>
    <header class="header" ref="header">
        <h2 class="title">{{ text }}</h2>

        <!-- Botón hamburguesa -->
        <button class="menu-toggle" @click.stop="toggleMenu">
            ☰
        </button>

        <nav ref="nav" :class="['nav', { 'is-active': menuOpen }]">
            <ul class="nav-list">
                <li class="nav-item">
                    <router-link to="/inventary" class="nav-link" @click="closeMenu">Inventario</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/main" class="nav-link" @click="closeMenu">Órdenes</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link" @click="closeMenu">Almacén</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/" class="nav-link logout" @click="logout">LogOut</router-link>
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
            menuOpen: false, // Estado del menú
        };
    },
    methods: {
        logout() {
            localStorage.clear();
            this.menuOpen = false; // Cierra el menú al cerrar sesión
        },
        toggleMenu() {
            this.menuOpen = !this.menuOpen;
        },
        closeMenu(event) {
            if (this.menuOpen) {
                const nav = this.$refs.nav;
                const button = document.querySelector(".menu-toggle");

                // Si el clic fue fuera del menú y fuera del botón, se cierra
                if (nav && !nav.contains(event.target) && button && !button.contains(event.target)) {
                    this.menuOpen = false;
                }
            }
        },
    },
    mounted() {
        document.addEventListener("click", this.closeMenu);
    },
    beforeUnmount() {
        document.removeEventListener("click", this.closeMenu);
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
    align-items: center;
    justify-content: space-between;
    width: 80%;
    margin: auto;
}

.title {
    color: white;
    font-size: 1.8rem;
    font-weight: bold;
}

/* Estilos para el botón hamburguesa */
.menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 2rem;
    color: white;
    cursor: pointer;
}

.nav {
    width: 100%;
}

.nav-list {
    list-style: none;
    display: flex;
    gap: 1.2rem;
    padding: 0;
    justify-content: end;
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

/* RESPONSIVE */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    .nav {
        display: none;
        width: 30%;
        position: absolute;
        top: 2.5rem;
        right: 3rem;
        background: #2c3e50;
        text-align: center;
        border-radius: 10px;
    }

    .nav.is-active {
        display: block;
    }

    .nav-list {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
    }

    .nav-link {
        display: block;
        width: 60%;
        font-size: 0.75rem;
    }
}
</style>
