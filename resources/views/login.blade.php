<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0f0231;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffffb6;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(212, 212, 212, 0.2), 0 10px 20px rgba(192, 192, 192, 0.15);
            padding: 40px;
            width: 300px;
            text-align: center;
        }


        .login-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            background-color: #ffffff9d;
            border: 1px solid #ccccccce;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0B7F9C;
        }

        .btn {
            background-color: #FFA20A;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #FF5733;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        #logo img {
        height: 80%; /* Hace que la imagen ocupe todo el ancho disponible del contenedor */
        width: auto; /* Mantiene la proporción de la imagen al ajustar el ancho */
        max-height: 50px; /* Define una altura máxima para la imagen */
        object-fit: contain; /* Ajusta la imagen para que se ajuste dentro del contenedor */
        }

        @font-face {
            font-family: 'GeosansLight';
            src: url('GeosansLight.ttf') format('truetype');
        }

        @font-face {
            font-family: 'CaviarDreams';
            src: url('CaviarDreams.ttf') format('truetype');
        }

        @font-face {
            font-family: 'Themundayfreeversion';
            src: url('Themundayfreeversion-Regular.ttf') format('truetype');
        }

        h2{
            font-family:'Themundayfreeversion'
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div id="logo">
            <img src="logo.png" alt="Nombre_de_la_imagen">
        </div>
        <h2>Sign In</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="email" style="font-family: 'CaviarDreams';">Email:</label>
                <input type="text" id="email" name="email" v-model="email" required>
                <div class="error-message">{{ errorMessage.email }}</div>
            </div>
            <div class="form-group">
                <label for="password" style="font-family: 'CaviarDreams';">Password:</label>
                <input type="password" id="password" name="password" v-model="password" required>
                <div class="error-message">{{ errorMessage.password }}</div>
            </div>
            <br>
            <button type="button" class="btn" @click="login">Login</button>
            <div class="error-message" id="error-message">{{ errorMessage.generic }}</div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js"></script>
    <script>
        new Vue({
            el: '.login-container',
            data() {
                return {
                    email: '',
                    password: '',
                    errorMessage: { email: '', password: '', generic: '' }
                }
            },
            methods: {
                login() {
                    if (!this.email || !this.password) {
                        this.errorMessage.generic = 'Por favor, ingrese su correo electrónico y contraseña';
                        return;
                    }
    
                    axios.post('http://127.0.0.1:8000/api/login/', {
        email: this.email,
        password: this.password
    })
    .then(response => {
        const token = response.data.token;
        const role = response.data.role;

        localStorage.setItem('token', token);

        if (role === 1) {
            window.location.href = 'principalAdmin.html'; // Redirigir al usuario a la página de solo lectura
        } else if (role === 2) {
            window.location.href = 'agenda.html'; // Redirigir al usuario a la página de escritura
        } else {
            this.errorMessage.generic = 'Rol no válido';
        }
    })
    .catch(error => {
        if (error.response.status === 401) {
            this.errorMessage.generic = 'Correo electrónico o contraseña incorrectos';
        } else {
            this.errorMessage.generic = 'Se produjo un error al procesar la solicitud. Por favor, inténtelo de nuevo más tarde';
        }
    });

                }
            }
        });
    </script>
    
</body>

</html>
