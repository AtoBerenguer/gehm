<template>
    <div class="modal">
        <div class="modal-content">
            <h3>TAREA SELECCIONADA {{ tarea.id_ticket }}</h3>
            <p><strong>ID:</strong> {{ tarea.id_ticket }}</p>
            <p><strong>Categoría:</strong> {{ tarea.nombre_categoria }}</p>
            <p><strong>Modelo:</strong> {{ tarea.nombreModelo }}</p>
            <p><strong>Estado:</strong> {{ tarea.estado }}</p>
            <p><strong>Descripción averia:</strong> {{ tarea.averia }}</p>
            <p><strong>Comentario técnico:</strong> {{ tarea.comentario }}</p>
            <p><strong>Técnico:</strong> {{ tarea.usuario }}</p>


            <form @submit.prevent="actualizarComentario">
                <div class="descripcion-container" v-if="tarea.estado === 'Pendiente'">
                    <input v-model="comentario" class="descripcion" type="text"
                        placeholder="Descripción de la reparación" />
                    <button class="updateBtn" type="submit">Actualizar</button>
                </div>
            </form>
            <p v-if="avisoUpdate" class="validate-text">{{ avisoUpdate }}</p>
            <p v-if="errorUpdate" class="error-text">{{ errorUpdate }}</p>

            <div class="Buttons">
                <button class="closeBtn" @click="$emit('cerrarModalTareaSelect')">X</button>
                <button v-if="tarea.estado === 'Pendiente'" class="finalizar" @click="finalizarTarea">Finalizar</button>
            </div>
        </div>

    </div>
</template>
<!-- v-if="roleId !== '3'" -->
<script>
import axios from 'axios';
export default {
    props: {
        tarea: Object,
    },
    data() {
        return {
            roleId: null,
            comentario: '',
            avisoUpdate: '',
            errorUpdate: '',
        };
    },
    mounted() {
        this.roleId = localStorage.getItem("rol_id");

    },
    methods: {
        actualizarComentario() {
            this.avisoUpdate = ''; // Reiniciar el aviso de actualización
            this.errorUpdate='';
            if (this.comentario.trim() === '') { //validación para que el comentario no este vacío
                this.errorUpdate='El comentario no puede estar vacío.';
                return;
            }

            const formData = new FormData();
            formData.append('id_ticket', this.tarea.id_ticket);
            formData.append('comentario', this.comentario);

            axios.post('http://localhost/BDD-MedicalEquipment/controller/tickets/updateComentary.php', formData)
                .then(response => {
                    
                    this.avisoUpdate=(response.data);
                })
                .catch(error => {
                    console.error('Hubo un error:', error);
                    alert('Error al actualizar el comentario.');
                });
        },
        finalizarTarea() {
            if (confirm("¿Está seguro de finalizar esta tarea?")) {
                const formData = new FormData();
                formData.append('id_ticket', this.tarea.id_ticket);
                axios.post('http://localhost/BDD-MedicalEquipment/controller/tickets/closeTicket.php', formData)
                    .then(response => {
                        console.log(response.data);
                        
                        this.$emit('cerrarModalTareaSelect');
                    })
                    .catch(error => {
                        console.error('Hubo un error:', error);
                        alert('Error al finalizar la tarea.');
                    });
            }
        }
    }
};    
</script>

<style scoped>
.validate-text{
  color: green;
  font-size: 0.9rem;
  margin-top: 4px;
}
.error-text {
  color: red;
  font-size: 0.9rem;
  margin-top: 4px;
}
.finalizar {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    background-color: #2ecc71;
    color: white;
    margin-top: 10px;
}

.updateBtn {
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    background-color: #3498db;
    color: white;
    margin-top: 10px;
    margin-left: 10px;
}

.descripcion-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1%;
}

.descripcion {
    height: 3rem;
    width: 80%;
    border-radius: 8px;
}

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

.Buttons {
    margin-top: 2rem;
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

.modal-content {
    background: #2c3e50;
    padding: 20px;
    border-radius: 12px;
    width: 400px;
    text-align: left;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ecf0f1;


}

h3 {
    font-size: 1.5rem;
    color: #1abc9c;
    margin-bottom: 15px;
}

p {
    overflow-wrap: break-word;
    max-width: 100%;
}
</style>