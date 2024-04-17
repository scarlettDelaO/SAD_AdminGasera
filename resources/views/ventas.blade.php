<!DOCTYPE html>
<html>

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
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Ventas</h1>
                <!-- Botón CREAR -->
                <v-card class="mx-auto mt-5" color="transparent" max-width="1280" elevation="0">
                    <div>
                        <v-btn class="mx-2" fab dark color="#0B7F9C" @click="formNuevo() ">
                            <v-icon dark>mdi-plus</v-icon>
                        </v-btn>
                    </div>
                    <div>
                        <!-- Tabla y formulario -->
                        <v-simple-table class="mt-5 ">
                            <template v-slot:default>
                                <thead>
                                    <tr class="pink darken-2 ">
                                        <th class="white--text ">ID</th>
                                        <th class="white--text ">Cliente</th>
                                        <th class="white--text ">Fecha</th>
                                        <th class="white--text ">Cantidad</th>
                                        <th class="white--text ">Descuento</th>
                                        <th class="white--text ">Pago</th>
                                        <th class="white--text ">Total</th>
                                        <th class="white--text text-center "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venta in ventas" :key="venta.id">
                                        <td>{{ venta.id }}</td>
                                        <td>{{ venta.customer.name }} {{ venta.customer.paternal_surname }} {{ venta.customer.maternal_surname }}</td>
                                        <td>{{ venta.date }}</td>
                                        <td>{{ venta.quantity }}</td>
                                        <td>{{ venta.discount }}</td>
                                        <td>{{ venta.payment.name }}</td>
                                        <td>{{ venta.total }}</td>

                                        <td style align="center">
                                            <v-btn fab dark color="#0B7F9C" dark small fab @click="formEditar(venta.id, venta.id_customers, venta.date, venta.quantity, venta.discount, venta.id_pay, venta.total)"><v-icon>mdi-pencil</v-icon></v-btn>
                                            <v-btn fab dark color="#0B7F9C" fab dark small @click="borrar(venta.id) "><v-icon>mdi-delete</v-icon></v-btn>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </div>
                </v-card>
                <!-- Componente de Diálogo para CREAR y EDITAR -->
                <v-dialog v-model="dialog " max-width="500 ">
                    <v-card>
                        <v-card-title class="pink darken-4 white--text ">Ventas</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="venta.id " hidden></input>
                                        <v-col cols="12">
                                            <v-select v-model="venta.customer_id" :items="clientes" item-text="fullName" item-value="id" label="Cliente" solo required>{{ venta.customer_id }}</v-select>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="venta.date" label="Fecha de Venta (AAAA-MM-DD)" solo required>{{ venta.date }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="venta.quantity" label="Cantidad" solo required>{{ venta.quantity }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="venta.discount" label="Descuento" solo required>{{ venta.discount }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select v-model="venta.pay_id" :items="pagos" item-text="name" item-value="id" label="Método de Pago" solo required>{{ venta.pay_id }}</v-select>
                                        </v-col>

                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialog=false " color="blue-grey " dark>Cancelar</v-btn>
                            <v-btn @click="guardar() " type="submit " dark color="#0B7F9C">Guardar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js " crossorigin=" anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js "></script>
    <script>
        let url = 'http://127.0.0.1:8000/api/ventas/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    clientes: [],
                    pagos: [],
                    ventas: [],
                    dialog: false,
                    operacion: '',
                    venta: {
                        id: null,
                        customer_id: '',
                        date: '',
                        quantity: '',
                        discount: '',
                        pay_id: ''
                    }
                }
            },
            created() {
                this.mostrar();
                this.cargarDatos();
            },
            methods: {
                mostrar: function() {
                    axios.get(url)
                        .then(response => {
                            this.ventas = response.data;
                        });
                },
                cargarDatos() {
                    axios.get('http://127.0.0.1:8000/api/data').then((response) => {
                        this.clientes = response.data.customers.map(cliente => {
                            cliente.fullName = `${cliente.name} ${cliente.paternal_surname} ${cliente.maternal_surname}`;
                            return cliente;
                        });
                        this.pagos = response.data.payment_methods;
                    });
                },
                crear: function() {
                    let parametros = {
                        customer_id: this.venta.customer_id,
                        date: this.venta.date,
                        quantity: this.venta.quantity,
                        discount: this.venta.discount,
                        pay_id: this.venta.pay_id
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                            Swal.fire('Creado', 'El registro se ha creado exitosamente', 'success');
                        })
                        .catch(error => {
                            console.error("Error al crear:", error);
                            Swal.fire('Error', 'No se pudo crear el registro: ' + error.message, 'error');
                        });
                },
                editar: function() {
                    let parametros = {
                        customer_id: this.venta.customer_id,
                        date: this.venta.date,
                        quantity: this.venta.quantity,
                        discount: this.venta.discount,
                        pay_id: this.venta.pay_id,
                        id: this.venta.id
                    };
                    axios.put(url + this.venta.id, parametros)
                        .then(response => {
                            this.mostrar();
                            Swal.fire('Actualizado', 'El registro se ha actualizado exitosamente', 'success');
                        })
                        .catch(error => {
                            console.error("Error al actualizar:", error);
                            Swal.fire('Error', 'No se pudo actualizar el registro: ' + error.message, 'error');
                        });
                },

                borrar: function(id) {
                    Swal.fire({
                        title: '¿Confirma eliminar el registro?',
                        confirmButtonText: `Confirmar`,
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(url + id)
                                .then(response => {
                                    this.mostrar();
                                });
                            Swal.fire('¡Eliminado!', '', 'success')
                        }
                    });
                },
                guardar: function() {
                    if (this.operacion == 'crear') {
                        this.crear();
                    } else if (this.operacion == 'editar') {
                        this.editar();
                    }
                    this.dialog = false;
                },
                formNuevo: function() {
                    this.dialog = true;
                    this.operacion = 'crear';
                    this.venta = {
                        id: null,
                        customer_id: '',
                        date: '',
                        quantity: '',
                        discount: '',
                        pay_id: ''
                    };
                },
                formEditar: function(id, customer_id, date, quantity, discount, pay_id) {
                    this.venta.id = id;
                    this.venta.customer_id = customer_id;
                    this.venta.date = date;
                    this.venta.quantity = quantity;
                    this.venta.discount = discount;
                    this.venta.pay_id = pay_id;
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>


</body>

</html>