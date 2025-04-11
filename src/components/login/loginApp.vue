<template>
  <div class="login-container">
    <h2>Login</h2>
        <form @submit.prevent="loginIn()">
      <div class="form-group">
        <label for="username">Email:</label>
        <input type="text" id="username" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    // fakeLogin() { // funcion para simular el login sin base de datos
    //   this.$router.push({ name: "tareasList" });
    // },
    async loginIn() { 
      try {
        const response = await fetch("http://localhost/BDD-MedicalEquipment/controller/users/logIn.php", {
          method: "POST",
          body: JSON.stringify({ email: this.email, password: this.password })
        });

        const data = await response.json();

        if (data.id_usuario) { //Añadimos el rol_id al localstorage para luego usarlo en el tareasList para mostrar las opciones correspondientes
          localStorage.setItem("rol_id", data.ROL_ID);
          localStorage.setItem("usuario_id", data.id_usuario);
          this.$router.push({ name: "tareasList" });
        } else {
          alert("Usuario o contraseña incorrectos");
        }
      } catch (error) {
        console.error("Error en el login:", error);
        alert("Error en el servidor");
      }
    }
  }
};
</script>

<style scoped>
.login-container {
  background: linear-gradient(135deg, #2c3e50, #398aa5);
  padding: 1.5rem;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  max-width: 400px;
  margin: 10rem auto;
  text-align: center;
  max-height: 300px;
  
}

h2 {
  color: #ecf0f1;
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 20px;
  margin-right: 2rem;
}

.form-group {
  margin-bottom: 15px;
  text-align: left;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #ecf0f1;
}

input {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ddd;
  background: #34495e;
  color: #ecf0f1;
  box-sizing: border-box;
}

input:focus {
  outline: none;
  border: 2px solid #1abc9c;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #1abc9c;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #16a085;
}
</style>