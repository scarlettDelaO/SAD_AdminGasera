<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,minimal-ui">
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
                <br><br>
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Reporte de Ventas</h1>
                <v-card color="transparent" class="mx-auto mt-5" max-width="1280" elevation="0">
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-card color="#BBDEFB" class="pa-3">
                                    <div>Total Ganado: <strong>{{ totalGanado.toFixed(2) }} $</strong></div>
                                    <div>Total Descuentos: <strong>{{ totalDescuentos.toFixed(2) }} %</strong></div>
                                    <div>Mayor Descuento: <strong>{{ mayorDescuento.toFixed(2) }} %</strong></div>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-card color="#BBDEFB" class="pa-3">
                                    <div>Promedio de Totales: <strong>{{ promedioTotal.toFixed(2) }} $</strong></div>
                                    <div>Porcentaje de Totales: <strong>{{ promedioTotalPorcentaje.toFixed(2) }}%</strong></div>
                                    <div>Total Litros Vendidos: <strong>{{ totalLitros.toFixed(2) }}</strong></div>
                                </v-card>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-card color="#BBDEFB" class="pa-3">
                                    <div>Cliente Frecuente: <strong>{{ clienteMayorConsumo }}</strong></div>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card>

                <v-card class="mx-auto mt-5" color="transparent" max-width="1280" elevation="0">
                    <v-simple-table class="mt-5">
                        <template v-slot:default>
                            <thead>
                                <tr class="pink darken-2">
                                    
                                    <th class="white--text">Cliente</th>
                                    <th class="white--text">Fecha</th>
                                    <th class="white--text">Cantidad</th>
                                    <th class="white--text">Descuento</th>
                                    <th class="white--text">Pago</th>
                                    <th class="white--text">Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="venta in ventas" :key="venta.id">
                                    
                                    <td>{{ venta.customer.name }} {{ venta.customer.paternal_surname }} {{ venta.customer.maternal_surname }}</td>
                                    <td>{{ venta.date }}</td>
                                    <td>{{ venta.quantity }}</td>
                                    <td>{{ venta.discount }}</td>
                                    <td>{{ venta.payment.name }}</td>
                                    <td>{{ venta.total }}</td>
                                    
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </v-card>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    ventas: [],
                    dialog: false,
                    venta: {}
                };
            },
            computed: {
                totalGanado() {
                    return this.ventas.reduce((total, venta) => total + parseFloat(venta.total), 0);
                },
                promedioTotal() {
                    const total = this.totalGanado;
                    const promedio = this.ventas.length ? total / this.ventas.length : 0;
                    return promedio;
                },
                promedioTotalPorcentaje() {
                    const total = this.totalGanado;
                    const promedio = this.promedioTotal;
                    return total > 0 ? (promedio / total) * 100 : 0; // Calcula el porcentaje que el promedio representa del total
                },
                totalDescuentos() {
                    return this.ventas.reduce((total, venta) => total + parseFloat(venta.discount || 0), 0);
                },
                mayorDescuento() {
                    return Math.max(...this.ventas.map(venta => parseFloat(venta.discount || 0)));
                },
                totalLitros() {
                    return this.ventas.reduce((total, venta) => total + parseFloat(venta.quantity), 0);
                },
                clienteMayorConsumo() {
                    const totalesPorCliente = this.ventas.reduce((totals, venta) => {
                        const nombreCompleto = `${venta.customer.name} ${venta.customer.paternal_surname} ${venta.customer.maternal_surname}`;
                        totals[nombreCompleto] = (totals[nombreCompleto] || 0) + venta.total;
                        return totals;
                    }, {});
                    return Object.keys(totalesPorCliente).reduce((a, b) => totalesPorCliente[a] > totalesPorCliente[b] ? a : b, '');
                }
            },
            methods: {
                cargarVentas() {
                    axios.get('http://127.0.0.1:8000/api/ventas/')
                        .then(response => {
                            this.ventas = response.data;
                        })
                        .catch(error => {
                            console.error("Error al cargar las ventas:", error);
                        });
                },

            },
            created() {
                this.cargarVentas();
            }
        });
    </script>
</body>

</html>