<template>
    <div class="modal">
        <div class="modal-content">
            
            <select v-model="opcionSeleccionada" @change="cambiarOpcion">
                <option value="crear">Crear Usuario</option>
                <option value="mod">Modificar Usuario</option>
            </select>

            <div v-if="mostrarCrearUsuario" class="crearUser">
                <form @submit.prevent="guardarUser">
                <h2>Crear Usuario</h2>
                <label for="nombre">Nombre:</label>
                <input v-model="nuevoUser.nombre" type="text" placeholder="Ingrese el nombre">

                <label for="Apellidos">Apellidos:</label>
                <input v-model="nuevoUser.apellidos" type="text" placeholder="Ingrese el apellidos">

                <label for="Email">Email:</label>
                <input v-model="nuevoUser.email" type="email" placeholder="Ingrese el email">

                <label for="Password">Password:</label>
                <input v-model="nuevoUser.password"  type="password" placeholder="Ingrese el password">

                <label for="rol_id">Rol:</label>
                <select v-model="nuevoUser.rol_id" name="rol_id" id="rol_id">
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                    <option value="3">Tecnico</option>
                </select>

                <div v-if="errorUser" class="error-text">{{ errorUser }}</div>

                <button class="guardarBtn" type="submit">Guardar</button>
            </form>
            </div>

            <div v-if="mostrarModUser" class="modUsers">
                <form @submit.prevent="actualizarRolUser">
                <h2>Modificar rol de usuario</h2>
                <label for="id_usuario">Usuarios: </label>
                <select v-model="updateUser.id_usuario" name="id_usuario" id="id_usuario">
                    <option v-for="usuario in usuarios" :key="usuario.id_usuario" :value="usuario.id_usuario">
                      {{ usuario.id_usuario }} -  {{ usuario.nombre }} {{ usuario.apellidos }}
                    </option>
                </select>
                <label for="rol_id">Rol:</label>
                <select v-model="updateUser.rol_id" name="rol_id" id="rol_id">
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                    <option value="3">Tecnico</option>
                </select>
                <div v-if="errorRolUser" class="error-text">{{ errorRolUser }}</div>
                <button class="guardarBtn" type="submit">Actualizar</button>
            </form>
            </div>

            
            <div class="modal-buttons">
                <button class="closeBtn" @click="$emit('cerrarModal')">Cerrar</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ["mostrarModal"],
    data() {
        return {
            errorUser:"",
            errorRolUser: "",
            opcionSeleccionada: "crear",
            mostrarCrearUsuario: true,
            mostrarModUser: false,
            usuarioSeleccionado: null,
            nuevoUser: {
                nombre: "",
                apellidos: "",
                email: "",
                password: "",
                rol_id: "",
                
            },
            updateUser:{
                id_usuario: "",
                rol_id: "",
            },
            usuarios: [],
        }
        


    },
    mounted() {
        this.cargarUsuarios();
    },
    methods: {
        cambiarOpcion() {
            if (this.opcionSeleccionada === "crear") {
                this.mostrarCrearUsuario = true;
                this.mostrarModUser = false;
            } else {
                this.mostrarCrearUsuario = false;
                this.mostrarModUser = true;
            }
        },
        cargarUsuarios() {
            axios.get("http://localhost/BDD-MedicalEquipment/controller/users/getAll_users.php")
                .then(response => {
                    this.usuarios = response.data;
                    
                })
                .catch(error => {
                    console.error("Error cargando usuarios:", error);
                });
        },
        guardarUser(){
            this.errorUser = "";
            const { nombre, apellidos, email, password, rol_id } = this.nuevoUser;
            if (!nombre || !apellidos || !email || !password || !rol_id) {
                this.errorUser ="Todos los campos son obligatorios";
                return;
            }

            let formData = new FormData();
            formData.append("nombre", nombre);
            formData.append("apellidos", apellidos);
            formData.append("email", email);
            formData.append("password", password);
            formData.append("rol_id", rol_id);

            axios.post("http://localhost/BDD-MedicalEquipment/controller/users/create_users.php", formData)
                .then(response => {
                    console.log("Usuario creado:", response.data);
                    this.cargarUsuarios();
                })
                .catch(error => {
                    console.error("Error creando usuario:", error);
                });
        },

        actualizarRolUser(){
            this.errorRolUser = "";
            const { id_usuario, rol_id } = this.updateUser;
            if (!id_usuario || !rol_id) {
                this.errorRolUser="Todos los campos son obligatorios";
                return;
            }

            let formData = new FormData();
            formData.append("id_usuario", id_usuario);
            formData.append("rol_id", rol_id);

            axios.post("http://localhost/BDD-MedicalEquipment/controller/users/modRolUser.php", formData)
                .then(response => {
                    console.log("Rol de usuario actualizado:", response.data);
                    this.cargarUsuarios();
                })
                .catch(error => {
                    console.error("Error actualizando rol de usuario:", error);
                });

        }

    }
};
</script>

<style scoped>
.error-text {
  color: red;
  font-size: 0.9rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
}
.guardarBtn{
    background-color: #1abc9c;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
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
}

.modal-content {
    background: #34495e;
    padding: 20px;
    border-radius: 10px;
    width: 500px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    color: #ecf0f1;
}

h2 {
    font-size: 1.8rem;
    color: #1abc9c;
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #ecf0f1;
    font-size: 1rem;
}

input,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: none;
    background: #2c3e50;
    color: #ecf0f1;
    font-size: 1rem;
    box-sizing: border-box;
}

input:focus,
select:focus {
    outline: none;
    border: 2px solid #1abc9c;
}

.modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.closeBtn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    background-color: red;
    color: white;
}


</style>