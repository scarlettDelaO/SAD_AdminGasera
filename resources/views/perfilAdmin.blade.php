<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,minimal-ui">
    <style>
        #app {
            background-color: #d1d0d0;
        }

        /* Estilos para el encabezado */
        #header {
            background-color: #0f0231;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #logo img {
        height: 80%; /* Hace que la imagen ocupe todo el ancho disponible del contenedor */
        width: auto; /* Mantiene la proporción de la imagen al ajustar el ancho */
        max-height: 50px; /* Define una altura máxima para la imagen */
        object-fit: contain; /* Ajusta la imagen para que se ajuste dentro del contenedor */
    }

        #menu {
            display: flex;
            gap: 20px;
        }

        #menu a {
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            padding: 10px;
            transition: all 0.3s ease;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        #menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        #perfilForm {
        width: 600px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 60px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-family: 'CaviarDreams';
    }

    input[type="text"],
    input[type="password"],
    input[type="number"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    .btnG {
            background-color: #FFA20A;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

    .btnG:hover {
            background-color: #faee45;
            color: #9c9c9c;
        }

    .btnC {
            background-color: #FF5733;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

    .btnC:hover {
            background-color: #fc8368;
            color: #575656;
            
        }
    </style>
</head>
<body>
    <div id="app">
        <div id="header">
            <div id="logo">
                <a href="principalAdmin.html"><img src="logo.png" alt="Nombre_de_la_imagen"></a>
            </div>
            <!--***********************CAMBIAR LOS ENLACES**************************-->
            <div id="menu">
                <a href="#">Ventas</a> 
                <a href="clientes.html">Clientes</a>
                <a href="vendedores.html">Vendedores</a>
                <a href="pipas.html">Pipas</a>
                <a href="detalles.html">Detalles del precio</a>
                <a href="perfilAdmin.html">Perfil</a>
            </div>
        </div>
    </div>

    <div id="perfilForm">
        <form>
            <div class="form-group">
                <label for="name" style="font-family: 'CaviarDreams';">Nombre:</label>
                <input type="text" id="name" name="name" v-model="name" required autocomplete="name">
            </div>            
            <div class="form-group">
                <label for="lastname" style="font-family: 'CaviarDreams';">Apellido:</label>
                <input type="text" id="lastname" name="lastname" v-model="lastname" required>
            </div>
            <div class="form-group">
                <label for="phone" style="font-family: 'CaviarDreams';">Teléfono:</label>
                <input type="number" id="phone" name="phone" v-model="phone" required>
            </div>
            <div class="form-group">
                <label for="address" style="font-family: 'CaviarDreams';">Dirección:</label>
                <input type="text" id="address" name="address" v-model="address" required>
            </div>
            <div class="form-group">
                <label for="nss" style="font-family: 'CaviarDreams';">NSS:</label>
                <input type="number" id="nss" name="nss" v-model="nss" required>
            </div>
            <div class="form-group">
                <label for="email" style="font-family: 'CaviarDreams';">Email:</label>
                <input type="email" id="email" name="email" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password" style="font-family: 'CaviarDreams';">Contraseña:</label>
                <input type="password" id="password" name="password" v-model="password" required>
            </div>
            <br>
            <div id="botones" class="row" >
            <div id="btnGuardar"  class="col-lg-4 text-center">
                <button type="button" class="btnG">Guardar</button>
            </div>
            <div class="col-lg-4"></div>
            <div id="btnClose" class="col-lg-4 text-center">
                <button type="button" class="btnC" onclick="logout()">Cerrar sesión</button>
            </div>
        </div>
        </form>
    </div>
    <!-- Importa Vue.js y Vuetify -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <!-- Importa Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        // Método para cerrar sesión
        function logout() {
            localStorage.removeItem('token');
            window.location.href = 'login2.html';
        }

        // Obtener el token de autenticación del almacenamiento local
        const token = localStorage.getItem('token');

        // Verificar si el token existe
        if (token) {
            // Hacer una solicitud para obtener los datos del perfil del usuario
            axios.get('http://127.0.0.1:8000/api/perfil', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    console.log(response.data); // Verifica qué datos se están devolviendo en la respuesta
                    const perfil = response.data;
                    console.log(perfil); // Aquí puedes acceder a los datos del perfil del usuario
                    // Resto del código para llenar los campos del formulario
                })
                .catch(error => {
                    // Manejar errores
                    console.error('Error al obtener datos del perfil:', error);
                });
        } else {
            // El token de autenticación no está presente, redirigir al usuario a la página de inicio de sesión
            window.location.href = 'login.html';
        }
    </script>
</body>

</html>