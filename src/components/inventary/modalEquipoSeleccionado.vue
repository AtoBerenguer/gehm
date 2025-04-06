<template>
    <div class="modal">
        <div class="modal-content">
            <h3>Detalles del Equipo</h3>
            <p><strong>ID:</strong> {{ equipo.id_inventario }}</p>
            <p><strong>Categoría:</strong> {{ equipo.nombre_categoria }}</p>
            <p><strong>Marca:</strong> {{ equipo.nombre_marca }}</p>
            <p><strong>Modelo:</strong> {{ equipo.nombre_modelo }}</p>
            <p><strong>Número de Serie:</strong> {{ equipo.numero_serie }}</p>
            <p><strong>Estado:</strong> {{ equipo.estado }}</p>
            <div class="Buttons">
                <button class="closeBtn" @click="$emit('cerrarModal')">Cerrar</button>
                <button 
                    v-if="roleId !== '3'" 
                    class="deleteBtn" 
                    @click="darDeBajaEquipo(equipo.id_inventario)"
                >
                    Dar de baja
                </button>
            </div> 
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        equipo: Object,
    },
    data() {
        return {
            roleId: null
        };
    },
    mounted() {
        this.roleId = localStorage.getItem("rol_id");
    },
    methods: {
        async darDeBajaEquipo(id_inventario) {
            if (confirm("¿Está seguro de dar de baja este equipo?")) {
                const formData = new FormData();
                formData.append('id_inventario', id_inventario);

                try {
                    const response = await axios.post(
                        'http://localhost/BDD-MedicalEquipment/controller/inventary/darBajaEquipo.php',
                        formData
                    );
                    console.log(response.data);
                    alert("Equipo dado de baja con éxito.");
                    this.$emit('cerrarModal');
                } catch (error) {
                    console.error("Error al cambiar el estado del equipo:", error);
                    alert("Ocurrió un error.");
                }
            }
        }
    }
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;


}

.modal-content {
    background: #2c3e50;
    padding: 20px;
    border-radius: 12px;
    width: 400px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ecf0f1;

}

h3 {
    font-size: 1.5rem;
    color: #1abc9c;
    margin-bottom: 15px;
}

p {
    background: #34495e;
    padding: 8px;
    border-radius: 6px;
    font-size: 1rem;
    color: #ecf0f1;
    text-align: left;
    margin-bottom: 10px;
}

.Buttons {
    display: flex;
    justify-content: space-around;
}

.closeBtn {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    background-color: #e74c3c;
    color: white;
    margin-top: 10px;

}

.deleteBtn {
    padding: 6px 12px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 0.8rem;
    background-color: #e74d3c67;
    color: white;
    margin-top: 10px;
}

button:hover {
    background-color: #c0392b;
}
</style>
