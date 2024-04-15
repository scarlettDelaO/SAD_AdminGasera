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
    </style>
</head>

<body>
    <div id="app">
        <div id="header">
            <div id="logo">
                <img src="logo.png" alt="Nombre_de_la_imagen">
            </div>
            <!--***********************CAMBIAR LOS ENLACES**************************-->
            <div id="menu">
                <a href="#">Ventas</a>
                <a href="vendedores.html">Vendedores</a>
                <a href="clientes.html">Clientes</a>
                <a href="#">Detalles del precio</a>
                <a href="#">Perfil</a>
            </div>
        </div>

        <v-app>
            <v-main>
                <br><br>
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Pipas</h1>
                <!-- Botón CREAR -->
                <v-card class="mx-auto mt-5" color="transparent" max-width="1280" elevation="0">
                    <div>
                        <v-btn class="mx-2" fab dark color="#FFA20A" @click="formNuevo() ">
                            <v-icon dark>mdi-plus</v-icon>
                            </v- btn>
                    </div>
                    <div>

                        <!-- Tabla y formulario -->
                        <v-simple-table class="mt-5 ">
                            <template v-slot:default>
                        <thead>
                        <tr style="background-color: #FF5733;">
                                <th class="white--text ">ID</th>
                                <th class="white--text ">Vendedor</th>
                                <th class="white--text ">Capacidad</th>
                                <th class="white--text ">NIV</th>
                                <th class="white--text ">Marca</th>
                                <th class="white--text ">Modelo</th>
                                
                                
                                <th class="white--text text-center "></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pipa in pipas" :key="pipa.id">
                                <td>{{ pipa.id }}</td>
                                <td>{{ encontrarVendedor(pipa.salesperson_id) }}</td>
                                <!--<td>{{ pipa.user ? pipa.user.name + ' ' + pipa.user.lastname : '' }}</td>-->
                                <td>{{ pipa.capacity}}</td>
                                <td>{{ pipa.niv}}</td>
                                <td>{{ pipa.brand }}</td>
                                <td>{{ pipa.model }}</td>
                                
                                <td style align="center">
                                <v-btn fab dark color="#FFA20A" dark small fab @click="formEditar(pipa.id, pipa.salesperson_id, pipa.capacity, pipa.niv, 
                                pipa.brand, pipa.model)"><v-icon>mdi-pencil</v-icon></v-btn>

                                <v-btn fab dark color="#FFA20A" fab dark small @click="borrar(pipa.id) "><v-icon>mdi-delete</v-
                                icon></v-btn>

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
                        <v-card-title class="pink darken-4 white--text ">Pipas</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="pipa.id " hidden></input>

                                        <v-col cols="12">
                                            <v-select v-model="pipa.salesperson_id" :items="vendedores" item-text="fullName" item-value="id" label="Vendedor" solo required>{{ pipa.salesperson_id }}</v-select>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pipa.capacity" label="Capacidad" solo required>{{ pipa.capacity }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pipa.niv" label="NIV" solo required>{{ pipa.niv }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pipa.brand" label="Marca" solo required>{{ pipa.brand }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pipa.model" label="Modelo" solo required>{{ pipa.model }}</v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="dialog=false " color="blue-grey " dark>Cancelar</v-btn>
                            <v-btn @click="guardar() " type="submit " dark color="#0B7F9C">Guardar</v-btn>
                        </v-card-actions>
                        </v-form>
                    </v-card>
                </v-dialog>
            </v-main>
        </v-app>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js" integrity="sha512-nqIFZC8560+CqHgXKez61MI0f9XSTKLkm0zFVm/99Wt0jSTZ7yeeYwbzyl0SGn/s8Mulbdw+ScCG41hmO2+FKw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js "></script>
    <script>
        let url = 'http://127.0.0.1:8000/api/pipas/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    vendedores: [],
                    pipas: [],
                    dialog: false,
                    operacion: '',
                    pipa: {
                        id: null,
                        salesperson_id: '',
                        capacity: '',
                        niv: '',
                        brand: '',
                        model: ''
                    }
                }
            },
            created() {
                this.mostrar()
                this.cargarDatos();
            },
            methods: {
                //MÉTODOS PARA EL CRUD
                mostrar: function() {
                    axios.get(url)
                        .then(response => {
                            this.pipas = response.data;
                            console.log(this.pipas);
                        })
                    /*return axios.get(url)
                        .then(response => {
                                this.pipas = response.data;
                                console.log(this.pipas);
                        })*/
                },
                encontrarVendedor(salesperson_id) {
                    const vendedor = this.vendedores.find(v => v.id === salesperson_id);
                    return vendedor ? `${vendedor.name} ${vendedor.lastname}` : '';
                },
                cargarDatos() {
                    axios.get('http://127.0.0.1:8000/api/data2').then((response) => {
                        this.vendedores = response.data.users.map(vendedor => {
                            vendedor.fullName = `${vendedor.name} ${vendedor.lastname}`;
                            return vendedor;
                        });
                    });
                },
                crear: function() {
                    let parametros = {
                        salesperson_id: this.pipa.salesperson_id,
                        capacity: this.pipa.capacity,
                        niv: this.pipa.niv,
                        brand: this.pipa.brand,
                        model: this.pipa.model
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.pipa.salesperson_id = "";
                    this.pipa.capacity = "";
                    this.pipa.niv = "";
                    this.pipa.brand = "";
                    this.pipa.model = "";

                },
                editar: function() {
                    let parametros = {
                        salesperson_id: this.pipa.salesperson_id,
                        capacity: this.pipa.capacity,
                        niv: this.pipa.niv,
                        brand: this.pipa.brand,
                        model: this.pipa.model,
                        id: this.pipa.id
                    };
                    //console.log(parametros);
                    axios.put(url+ this.pipa.id, parametros)
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
                    this.pipa = {
                        id: null,
                        salesperson_id: '',
                        capacity: '',
                        niv: '',
                        brand: '',
                        model: ''
                    };
                },
                formEditar: function(id, salesperson_id, capacity, niv, brand, model) {
                    this.pipa.id = id;
                    this.pipa.salesperson_id = salesperson_id; // Aquí combinamos apPaterno y apMaterno en lastname
                    this.pipa.capacity = capacity;
                    this.pipa.niv = niv;
                    this.pipa.brand = brand;
                    this.pipa.model = model;
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>