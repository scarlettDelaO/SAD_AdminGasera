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
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Detalles Del Precio</h1>
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
                                        <th class="white--text ">Id</th>
                                        <th class="white--text ">Precio Neto</th>
                                        <th class="white--text ">IVA</th>
                                        <th class="white--text ">Precio Publico</th>
                                        <th class="white--text ">Agregado</th>
                                        <th class="white--text text-center "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="detalle in detalles" :key="detalle.id">
                                        <td>{{ detalle.id }}</td>
                                        <td>{{ detalle.netPrice }}</td>
                                        <td>{{ detalle.iva }}</td>
                                        <td>{{ detalle.salePrice }}</td>
                                        <td>{{ detalle.aggregate }}</td>
                                        <td style align="center">
                                            <v-btn fab dark color="#0B7F9C" dark small fab @click="formEditar(detalle.id, detalle.netPrice, detalle.iva, detalle.salePrice, detalle.aggregate)"><v-icon>mdi-pencil</v-icon></v-btn>
                                            <v-btn fab dark color="#0B7F9C" fab dark small @click="borrar(detalle.id) "><v-icon>mdi-delete</v-icon></v-btn>
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
                        <v-card-title class="pink darken-4 white--text ">Detalles Del Precio</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="detalle.id " hidden></input>
                                        <v-col cols="12">
                                            <v-text-field v-model="detalle.netPrice" label="Precio Neto" solo required>{{ detalle.netPrice }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="detalle.iva" label="IVA" solo required>{{ detalle.iva }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="detalle.salePrice" label="Precio Publico" solo required>{{ detalle.salePrice }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="detalle.aggregate" label="Agregado" solo required>{{ detalle.aggregate }}</v-text-field>
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
        let url = 'http://127.0.0.1:8000/api/priceDetails/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    detalles: [],
                    dialog: false,
                    operacion: '',
                    detalle: {
                        id: null,
                        netPrice: '',
                        iva: '',
                        salePrice: '',
                        aggregate: ''
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
                            this.detalles = response.data;
                        })
                },
                crear: function() {
                    let parametros = {
                        netPrice: this.detalle.netPrice,
                        iva: this.detalle.iva,
                        salePrice: this.detalle.salePrice,
                        aggregate: this.detalle.aggregate
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.detalle.netPrice = "";
                    this.detalle.iva = "";
                    this.detalle.salePrice = "";
                    this.detalle.aggregate = "";
                },
                editar: function() {
                    let parametros = {
                        netPrice: this.detalle.netPrice,
                        iva: this.detalle.iva,
                        salePrice: this.detalle.salePrice,
                        aggregate: this.detalle.aggregate,
                        id: this.detalle.id
                    };
                    axios.put(url + this.detalle.id, parametros)
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
                    this.detalle = {
                        id: null,
                        netPrice: '',
                        iva: '',
                        salePrice: '',
                        aggregate: ''
                    };
                },
                formEditar: function(id, netPrice, iva, salePrice, aggregate) {
                    this.detalle.id = id;
                    this.detalle.netPrice = netPrice;
                    this.detalle.iva = iva;
                    this.detalle.salePrice = salePrice;
                    this.detalle.aggregate = aggregate;
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>