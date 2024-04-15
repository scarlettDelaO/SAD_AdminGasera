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
                <a href="clientes.html">Clientes</a>
                <a href="pipas.html">Pipas</a>
                <a href="#">Detalles del precio</a>
                <a href="#">Perfil</a>
            </div>
        </div>

        <v-app>
            <v-main>
                <br><br>
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Vendedores</h1>
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
                                <th class="white--text ">Nombre</th>
                                <th class="white--text ">Apellido</th>
                                <th class="white--text ">Nacimiento</th>
                                <th class="white--text ">Teléfono</th>
                                <th class="white--text ">Dirección</th>
                                <th class="white--text ">NSS</th>
                                <th class="white--text ">Email</th>
                                
                                
                                <th class="white--text text-center "></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vendedor in vendedores" :key="vendedor.id">
                                <td>{{ vendedor.id }}</td>
                                <td>{{ vendedor.name }}</td>
                                <td>{{ vendedor.lastname }}</td>
                                <td>{{ vendedor.birthdate }}</td>
                                <td>{{ vendedor.phone }}</td>
                                <td>{{ vendedor.address }}</td>
                                <td>{{ vendedor.nss }}</td>
                                <td>{{ vendedor.email }}</td>
                                
                                
                                <td style align="center">
                                <v-btn fab dark color="#FFA20A" dark small fab @click="formEditar(vendedor.id, vendedor.name, vendedor.lastname, vendedor.birthdate, 
                                vendedor.phone, vendedor.address, vendedor.nss, vendedor.email, vendedor.password)"><v-icon>mdi-pencil</v-icon></v-btn>

                                <v-btn fab dark color="#FFA20A" fab dark small @click="borrar(vendedor.id) "><v-icon>mdi-delete</v-
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
                        <v-card-title class="pink darken-4 white--text ">Vendedores</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="vendedor.id " hidden></input>

                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.name" label="Nombre" solo required>{{ vendedor.name }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.lastname" label="Apellido(s)" solo required>{{ vendedor.lastname }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.birthdate" label="Fecha de Nacimiento (AAAA-MM-DD)" solo required>{{ vendedor.birthdate }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.phone" label="Teléfono" solo required>{{ vendedor.phone }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.address" label="Dirección" solo required>{{ vendedor.address }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.nss" label="NSS" solo required>{{ vendedor.nss }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.email" label="Email" solo required>{{ vendedor.email }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="vendedor.password" label="Contraseña" solo>{{ vendedor.password }}</v-text-field>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.js " integrity="sha512- nqIFZC8560+CqHgXKez61MI0f9XSTKLkm0zFVm/99Wt0jSTZ7yeeYwbzyl0SGn/s8Mulbdw+ScCG41hmO2+FKw==" crossorigin=" anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js "></script>
    <script>
        let url = 'http://127.0.0.1:8000/api/vendedores/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    vendedores: [],
                    dialog: false,
                    operacion: '',
                    vendedor: {
                        id: null,
                        name: '',
                        lastname: '',
                        birthdate: '',
                        phone: '',
                        address: '',
                        nss: '',
                        email: '',
                        password: ''
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
                            this.vendedores = response.data;
                        })
                },
                crear: function() {
                    let parametros = {
                        name: this.vendedor.name,
                        lastname: this.vendedor.lastname,
                        birthdate: this.vendedor.birthdate,
                        phone: this.vendedor.phone,
                        address: this.vendedor.address,
                        nss: this.vendedor.nss,
                        email: this.vendedor.email,
                        password: this.vendedor.password
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.vendedor.name = "";
                    this.vendedor.lastname = "";
                    this.vendedor.birthdate = "";
                    this.vendedor.phone = "";
                    this.vendedor.address = "";
                    this.vendedor.nss = "";
                    this.vendedor.email = "";
                    this.vendedor.password = "";

                },
                editar: function() {
                    let parametros = {
                        name: this.vendedor.name,
                        lastname: this.vendedor.lastname,
                        birthdate: this.vendedor.birthdate,
                        phone: this.vendedor.phone,
                        address: this.vendedor.address,
                        nss: this.vendedor.nss,
                        email: this.vendedor.email,
                        password: this.vendedor.password,
                        id: this.vendedor.id
                    };
                    //console.log(parametros);
                    axios.put(url + this.vendedor.id, parametros)
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
                    this.vendedor = {
                        id: null,
                        name: '',
                        lastname: '',
                        birthdate: '',
                        phone: '',
                        address: '',
                        nss: '',
                        email: '',
                        password: ''
                    };
                },
                formEditar: function(id, name, lastname, birthdate, email, phone, address, nss, password) {
                    this.vendedor.id = id;
                    this.vendedor.name = name;
                    this.vendedor.lastname = lastname; // Aquí combinamos apPaterno y apMaterno en lastname
                    this.vendedor.birthdate = birthdate;
                    this.vendedor.email = email;
                    this.vendedor.phone = phone;
                    this.vendedor.address = address;
                    this.vendedor.nss = nss;
                    // Solo actualiza el password si se ha proporcionado uno nuevo
                    if (password && password.trim() !== '') {
                        this.vendedor.password = password;
                    }
                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>