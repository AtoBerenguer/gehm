<template>
    <div class="modal">
        <div class="modal-content">

            <select v-model="opcionSeleccionada" @change="cambiarOpcion">
                <option value="password">Modificar Password</option>
                <option v-if="rolId == '1'" value="crear">Crear Usuario</option>
                <option v-if="rolId == '1'" value="mod">Modificar Rol</option>
                
            </select>

            <div v-if="mostrarModPassword" class="modUsers">
                <form @submit.prevent="actualizarPasswordUser">

                    <h2>Modificar contraseña</h2>
                    
                    <label for="password">Password:</label>
                    <input v-model="nuevoUser.password" type="password" placeholder="Ingrese el password">


                    <div v-if="errorPasswordUser" class="error-text">{{ errorPasswordUser }}</div>
                    <div v-if="ValidatePasswordUser" class="validate-text">{{ ValidatePasswordUser }}</div>
                    <button class="guardarBtn" type="submit">Actualizar</button>

                </form>
            </div>

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
                    <input v-model="nuevoUser.password" type="password" placeholder="Ingrese el password">

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
                            {{ usuario.id_usuario }} - {{ usuario.nombre }} {{ usuario.apellidos }}
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
            errorUser: "",
            errorRolUser: "",
            errorPasswordUser: "",
            ValidatePasswordUser: "",
            opcionSeleccionada: "password",
            mostrarCrearUsuario: true,
            mostrarModUser: false,
            mostrarModPassword: false,
            usuarioSeleccionado: null,
            rolId: null,
            id_usuario:null,
            nuevoUser: {
                nombre: "",
                apellidos: "",
                email: "",
                password: "",
                rol_id: "",

            },
            updateUser: {
                id_usuario: "",
                rol_id: "",
            },
            usuarios: [],
        }



    },
    mounted() {
        this.cargarUsuarios();
        this.rolId = localStorage.getItem("rol_id");
        this.cambiarOpcion();
        this.id_usuario = localStorage.getItem("usuario_id");
        
        
    },
    methods: {
        cambiarOpcion() {
            if (this.opcionSeleccionada === "password") {
                this.mostrarCrearUsuario = false;
                this.mostrarModUser = false;
                this.mostrarModPassword = true;
            } else if (this.opcionSeleccionada === "mod") {
                this.mostrarCrearUsuario = false;
                this.mostrarModUser = true;
                this.mostrarModPassword = false;
            } else if (this.opcionSeleccionada === "crear") {
                this.mostrarCrearUsuario = true;
                this.mostrarModUser = false;
                this.mostrarModPassword = false;
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
        guardarUser() {
            this.errorUser = "";
            const { nombre, apellidos, email, password, rol_id } = this.nuevoUser;
            if (!nombre || !apellidos || !email || !password || !rol_id) {
                this.errorUser = "Todos los campos son obligatorios";
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
        actualizarRolUser() {
            this.errorRolUser = "";
            const { id_usuario, rol_id } = this.updateUser;
            if (!id_usuario || !rol_id) {
                this.errorRolUser = "Todos los campos son obligatorios";
                return;
            }

            let formData = new FormData();
            formData.append("id_usuario", id_usuario);
            formData.append("rol_id", rol_id);

            axios.post("http://localhost/BDD-MedicalEquipment/controller/users/modRolUser.php", formData)
                .then(response => {
                    console.log(response.data);
                    this.cargarUsuarios();
                })
                .catch(error => {
                    console.error("Error actualizando rol de usuario:", error);
                });

        },
        actualizarPasswordUser(){
            this.errorPasswordUser = "";
            const { password } = this.nuevoUser;
            if (!password) {
                this.errorPasswordUser = "Contraseña obligaria";
                return;
            }
            if( password.length < 5){
                this.errorPasswordUser = "La contraseña debe tener al menos 5 caracteres";
                return;
            }

            let formData = new FormData();
            formData.append("id_usuario", this.id_usuario);
            formData.append("password", password);

            axios.post("http://localhost/BDD-MedicalEquipment/controller/users/modPassword.php", formData)
                .then(response => {
                    console.log(response.data);
                    this.cargarUsuarios();
                    this.ValidatePasswordUser ="Contraseña actualizada correctamente";
                })
                .catch(error => {
                    console.error("Error actualizando contraseña de usuario:", error);
                });
                this.nuevoUser.password = "";
        }

    }
};
</script>

<style scoped>
.validate-text{
    color: green;
    font-size: 0.9rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
}
.error-text {
    color: red;
    font-size: 0.9rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.guardarBtn {
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