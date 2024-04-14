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
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Prices</h1>
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
                                        <th class="white--text ">ID Detail</th>
                                        <th class="white--text ">Previous Price</th>
                                        <th class="white--text ">Change Date</th>
                                        <th class="white--text ">Reason</th>
                                        <th class="white--text ">Actual Price</th>
                                        <th class="white--text text-center "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="price in pricesList" :key="price.id">
                                        <td>{{ price.id }}</td>
                                        <td>{{ price.id_detail }}</td>
                                        <td>{{ price.previousPrice }}</td>
                                        <td>{{ price.changeDate }}</td>
                                        <td>{{ price.reason }}</td>
                                        <td>{{ price.actualPrice }}</td>
                                        <td style align="center">
                                            <v-btn fab dark color="#0B7F9C" dark small fab @click="formEditar(price.id, price.id_detail, price.previousPrice, price.changeDate, price.reason, price.actualPrice)"><v-icon>mdi-pencil</v-icon></v-btn>
                                            <v-btn fab dark color="#0B7F9C" fab dark small @click="borrar(price.id) "><v-icon>mdi-delete</v-icon></v-btn>
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
                        <v-card-title class="pink darken-4 white--text ">Prices</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="price.id " hidden></input>
                                        <v-col cols="12">
                                            <v-text-field v-model="price.id_detail" label="ID Detail" solo required>{{ price.id_detail }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="price.previousPrice" label="Previous Price" solo required>{{ price.previousPrice }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="price.changeDate" label="Change Date" solo required>{{ price.changeDate }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="price.reason" label="Reason" solo required>{{ price.reason }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="price.actualPrice" label="Actual Price" solo required>{{ price.actualPrice }}</v-text-field>
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
        let url = 'http://127.0.0.1:8000/api/prices/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    pricesList: [],
                    dialog: false,
                    operacion: '',
                    price: {
                        id: null,
                        id_detail: '',
                        previousPrice: '',
                        changeDate: '',
                        reason: '',
                        actualPrice: ''
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
                            this.pricesList = response.data;
                        })
                },
                crear: function() {
                    let parametros = {
                        id_detail: this.price.id_detail,
                        previousPrice: this.price.previousPrice,
                        changeDate: this.price.changeDate,
                        reason: this.price.reason,
                        actualPrice: this.price.actualPrice
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.price.id_detail = "";
                    this.price.previousPrice = "";
                    this.price.changeDate = "";
                    this.price.reason = "";
                    this.price.actualPrice = "";
                },
                editar: function() {
                    let parametros = {
                        id_detail: this.price.id_detail,
                        previousPrice: this.price.previousPrice,
                        changeDate: this.price.changeDate,
                        reason: this.price.reason,
                        actualPrice: this.price.actualPrice,
                        id: this.price.id
                    };
                    axios.put(url + this.price.id, parametros)
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
                    this.price = {
                        id: null,
                        id_detail: '',
                        previousPrice: '',
                        changeDate: '',
                        reason: '',
                        actualPrice: ''
                    };
                },
                formEditar: function(id, id_detail, previousPrice, changeDate, reason, actualPrice) {
                    this.price.id = id;
                    this.price.id_detail = id_detail;
                    this.price.previousPrice = previousPrice;
                    this.price.changeDate = changeDate;
                    this.price.reason = reason;
                    this.price.actualPrice = actualPrice;
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>
