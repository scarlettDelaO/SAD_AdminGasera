<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <style>
        #app {
            background-color: #e3f2f8;
        }
    </style>
</head>

<body>
    <div id="app">
        <v-app>
            <v-main>
                <v-container>
                    <!-- Título -->
                    <v-row>
                        <v-col>
                            <h1 class="text-center" style="font-family:'Kids On The Moon'; font-size: 50px;">Resumen de Actividades</h1>
                        </v-col>
                    </v-row>

                    <!-- Información de pedidos pendientes -->
                    <v-row>
                        <v-col>
                            <h2 class="text-center" style="font-size: 30px;">Pedidos Pendientes</h2>
                            <v-list dense>
                                <v-list-item v-for="pedido in pedidosPendientes" :key="pedido.id">
                                    <v-list-item-content>
                                        <v-list-item-title>{{ pedido.customerName }} - {{ pedido.quantity }}L</v-list-item-title>
                                        <v-list-item-subtitle>{{ pedido.date }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-col>
                    </v-row>

                    <!-- Información de Pipas -->
                    <v-row>
                        <v-col>
                            <h2 class="text-center" style="font-size: 30px;">Detalles de la Pipas</h2>
                            <v-list dense>
                                <v-list-item v-for="pipa in pipas" :key="pipa.id">
                                    <v-list-item-content>
                                        <v-list-item-title>{{ pipa.brand }} - {{ pipa.model }}</v-list-item-title>
                                        <v-list-item-subtitle>Capacidad: {{ pipa.capacity }}L </v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-col>
                    </v-row>

                    <!-- Precio Actual del Litro -->
                    <v-row>
                        <v-col>
                            <h2 class="text-center" style="font-size: 30px;">Precio Actual del Litro</h2>
                            <p class="text-center" style="font-size: 20px;">$ {{ precioActual }}</p>
                        </v-col>
                    </v-row>

                </v-container>
            </v-main>
        </v-app>
    </div>

    <!-- Incluir Vue, Vuetify, Axios y demás scripts necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    pedidos: [],
                    pedidosPendientes: [],
                    pipas: [],
                    precioActual: 9.94
                };
            },
            created() {
                this.cargarPedidosPendientes();
                this.cargarPipas();
                this.cargarPrecioActual();
            },
            methods: {
                cargarPedidosPendientes() {
                    axios.get('http://127.0.0.1:8000/api/pedidos').then((response) => {
                        this.pedidos = response.data.map(pedido => ({
                            ...pedido,
                            customerName: `${pedido.customer.name} ${pedido.customer.paternal_surname} ${pedido.customer.maternal_surname}`
                        }));
                        this.pedidosPendientes = this.pedidos.filter(pedido => pedido.status.name === 'Pendiente');
                    });
                },
                cargarPipas() {
                    axios.get('http://127.0.0.1:8000/api/pipas').then((response) => {
                        this.pipas = response.data;
                    });
                },
                cargarPrecioActual() {
                    // Supuesto método para cargar el precio actual, aquí iría la lógica para obtener dicho dato
                }
            }
        });
    </script>

</body>

</html>