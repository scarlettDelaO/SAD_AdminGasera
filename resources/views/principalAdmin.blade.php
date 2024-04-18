<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,minimal-ui">
    <style>
        #app {
            background-color: #e7e7e7;
            padding-bottom: 4%;
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

        @font-face {
            font-family: 'KidsOnTheMoon';
            src: url('KidsOnTheMoon.ttf') format('truetype');
        }

        h1{
            margin-top: 2%;
            font-family: 'KidsOnTheMoon';
            font-size: 60px;
        }

        h2{
            font-family: 'Themundayfreeversion';
        }

        #main img{
            width: 70%;
            margin-bottom:5%;
        }

        #foot{
            background-color: #0f0231;
            height: 70px;
        }

        h5{
            margin-top: 10%;
            margin-left: 10%;
            margin-right: 10%;
            font-family: 'CaviarDreams';
            font-size: 25px;
        }

        #clock{
            font-family: 'CaviarDreams';
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="header">
            <div id="logo">
                <a href="#"><img src="logo.png" alt="Nombre_de_la_imagen"></a>
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
        <br><br>
        <div id="main" class="row col-lg-12">
            <div class="col-lg-12 text-center">
                <h1 class="text-center">Gas Revolution</h1>
                <h2 class="text-center">Bienvenido!</h2>
            </div>
            <div class="row col-lg-12"> 
                <div class="col-lg-5 text-center" id="clock">
                    <div style="text-align:center;padding:1em 0;"> 
                        <h3>
                            <a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/city/3530597">
                                <span style="color:gray;">Time</span><br />
                            </a>
                        </h3> 
                        <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=medium&timezone=America%2FMexico_City" width="100%" height="115" frameborder="0" seamless></iframe> </div>
                </div>
                <div class="col-lg-2 text-center">
                    <img src="logo.png" alt="Nombre_de_la_imagen">
                </div>
                <div class="col-lg-5 text-center">
                    <h5>La seguridad y la innovación alimentan nuestro progreso</h5>
                </div>
            </div>
        </div>
    </div>
    <div id="foot"></div>
</body>