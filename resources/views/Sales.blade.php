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
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Sales</h1>
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
                                        <th class="white--text ">ID Customers</th>
                                        <th class="white--text ">ID Detail</th>
                                        <th class="white--text ">Date</th>
                                        <th class="white--text ">Quantity</th>
                                        <th class="white--text ">Discount</th>
                                        <th class="white--text ">ID Pay</th>
                                        <th class="white--text ">Total</th>
                                        <th class="white--text text-center "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sale in salesList" :key="sale.id">
                                        <td>{{ sale.id }}</td>
                                        <td>{{ sale.id_customers }}</td>
                                        <td>{{ sale.id_detail }}</td>
                                        <td>{{ sale.date }}</td>
                                        <td>{{ sale.quantity }}</td>
                                        <td>{{ sale.discount }}</td>
                                        <td>{{ sale.id_pay }}</td>
                                        <td>{{ sale.total }}</td>
                                        <td style align="center">
                                            <v-btn fab dark color="#0B7F9C" dark small fab @click="formEditar(sale.id, sale.id_customers, sale.id_detail, sale.date, sale.quantity, sale.discount, sale.id_pay, sale.total)"><v-icon>mdi-pencil</v-icon></v-btn>
                                            <v-btn fab dark color="#0B7F9C" fab dark small @click="borrar(sale.id) "><v-icon>mdi-delete</v-icon></v-btn>
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
                        <v-card-title class="pink darken-4 white--text ">Sales</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="sale.id " hidden></input>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.id_customers" label="ID Customers" solo required>{{ sale.id_customers }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.id_detail" label="ID Detail" solo required>{{ sale.id_detail }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.date" label="Date" solo required>{{ sale.date }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.quantity" label="Quantity" solo required>{{ sale.quantity }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.discount" label="Discount" solo required>{{ sale.discount }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.id_pay" label="ID Pay" solo required>{{ sale.id_pay }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="sale.total" label="Total" solo required>{{ sale.total }}</v-text-field>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js " integrity="sha512- nqIFZC8560+CqHgXKez61MI0f9XSTKLkm0zFVm/99Wt0jSTZ7yeeYwbzyl0SGn/s8Mulbdw+ScCG41hmO2+FKw==" crossorigin=" anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js "></script>
    <script>
        let url = 'http://127.0.0.1:8000/api/sales/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    salesList: [],
                    dialog: false,
                    operacion: '',
                    sale: {
                        id: null,
                        id_customers: '',
                        id_detail: '',
                        date: '',
                        quantity: '',
                        discount: '',
                        id_pay: '',
                        total: ''
                    }
                }
            },
            created() {
                this.mostrar()
            },
            methods: {
                //MÉTODOS PARA EL CRUD
                mostrar: function() {
                    axios.get(url)
                        .then(response => {
                            this.salesList = response.data;
                        })
                },
                crear: function() {
                    let parametros = {
                        id_customers: this.sale.id_customers,
                        id_detail: this.sale.id_detail,
                        date: this.sale.date,
                        quantity: this.sale.quantity,
                        discount: this.sale.discount,
                        id_pay: this.sale.id_pay,
                        total: this.sale.total
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.sale.id_customers = "";
                    this.sale.id_detail = "";
                    this.sale.date = "";
                    this.sale.quantity = "";
                    this.sale.discount = "";
                    this.sale.id_pay = "";
                    this.sale.total = "";
                },
                editar: function() {
                    let parametros = {
                        id_customers: this.sale.id_customers,
                        id_detail: this.sale.id_detail,
                        date: this.sale.date,
                        quantity: this.sale.quantity,
                        discount: this.sale.discount,
                        id_pay: this.sale.id_pay,
                        total: this.sale.total,
                        id: this.sale.id
                    };
                    axios.put(url + this.sale.id, parametros)
                        .then(response => {
                            this.mostrar();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                },
                borrar: function(id) {
                    Swal.fire({
                        title: '¿Confirma eliminar el registro?',
                        confirmButtonText: `Confirmar`,
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //procedimiento borrar
                            axios.delete(url + id)
                                .then(response => {
                                    this.mostrar();
                                });
                            Swal.fire('¡Eliminado!', '', 'success')
                        } else if (result.isDenied) {}
                    });
                },
                //Botones y formularios
                guardar: function() {
                    if (this.operacion == 'crear') {
                        this.crear();
                    }
                    if (this.operacion == 'editar') {
                        this.editar();
                    }
                    this.dialog = false;
                },
                formNuevo: function() {
                    this.dialog = true;
                    this.operacion = 'crear';
                    this.sale = {
                        id: null,
                        id_customers: '',
                        id_detail: '',
                        date: '',
                        quantity: '',
                        discount: '',
                        id_pay: '',
                        total: ''
                    };
                },
                formEditar: function(id, id_customers, id_detail, date, quantity, discount, id_pay, total) {
                    this.sale.id = id;
                    this.sale.id_customers = id_customers;
                    this.sale.id_detail = id_detail;
                    this.sale.date = date;
                    this.sale.quantity = quantity;
                    this.sale.discount = discount;
                    this.sale.id_pay = id_pay;
                    this.sale.total = total;
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>
