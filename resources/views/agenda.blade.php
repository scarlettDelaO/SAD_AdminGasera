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
            background-color: #e4e4e4;
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

        #menu a{
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            padding: 10px;
            transition: all 0.3s ease;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        #menu a:hover,  #logo a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="header">
            <!--***********************CAMBIAR LOS ENLACES**************************-->
            <div id="logo">
                <a href="#"><img src="logo.png" alt="Nombre_de_la_imagen"></a>
            </div>
            <!--***********************CAMBIAR LOS ENLACES**************************-->
            <div id="menu">
                <a href="#">Ventas</a>
                <a href="#">Perfil</a>
            </div>
        </div>

        <v-app>
            <v-main>
                <br><br>
                <h1 class="text-center" style="font-family:'Kids On The Moon' ; font-size: 50px;">Agenda</h1>
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
                                <th class="white--text ">Cliente</th>
                                <th class="white--text ">Fecha</th>
                                <th class="white--text ">Cantidad (L)</th>
                                <th class="white--text ">Dirección</th>
                                <th class="white--text ">Total</th>
                                <th class="white--text ">Estado</th>
                                
                                
                                <th class="white--text text-center "></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pedido in pedidos" :key="pedido.id">
                                <td>{{ pedido.id }}</td>
                                <td>{{ pedido.customer.name }} {{ pedido.customer.paternal_surname }} {{ pedido.customer.maternal_surname }}</td>
                                <td>{{ pedido.date }}</td>
                                <td>{{ pedido.quantity }}</td>
                                <td>{{ pedido.address }}</td>
                                <td>{{ pedido.total }}</td>
                                <td>{{ pedido.status.name }}</td>
                                
                                
                                <td style align="center">
                                    <v-btn fab dark color="#FFA20A" dark small fab @click="formEditar(pedido.id, pedido.customer_id, pedido.date, 
                                    pedido.quantity, pedido.address, pedido.statu_id)"> <v-icon>mdi-pencil</v-icon></v-btn>
    

                                <v-btn fab dark color="#FFA20A" fab dark small @click="borrar(pedido.id) "><v-icon>mdi-delete</v-
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
                        <v-card-title class="pink darken-4 white--text ">Agenda</v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-row>
                                        <input v-model="pedido.id " hidden></input>

                                        <v-col cols="12">
                                            <v-select v-model="pedido.customer_id" :items="clientes" item-text="fullName" item-value="id" label="Cliente" solo required>{{ pedido.customer_id }}</v-select>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pedido.date" label="Fecha (AAAA-MM-DD)" solo required>{{ pedido.date }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pedido.quantity" label="Cantidad" solo required>{{ pedido.quantity }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="pedido.address" label="Dirección" solo required>{{ pedido.address }}</v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select v-model="pedido.statu_id" :items="estados" item-text="name" item-value="id" label="Estado" solo required>{{ pedido.statu_id }}</v-select>
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
        let url = 'http://127.0.0.1:8000/api/pedidos/';
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data() {
                return {
                    clientes: [],
                    estados: [],
                    pedidos: [],
                    dialog: false,
                    operacion: '',
                    pedido: {
                        id: null,
                        customer_id: '',
                        date: '',
                        quantity: '',
                        address: '',
                        statu_id: ''
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
                            this.pedidos = response.data;
                            console.log(this.pedidos);
                            this.verificarPedidosPendientes();
                        })
                },
                cargarDatos() {
                    axios.get('http://127.0.0.1:8000/api/data').then((response) => {
                        this.clientes = response.data.customers.map(cliente => {
                            cliente.fullName = `${cliente.name} ${cliente.paternal_surname} ${cliente.maternal_surname}`;
                            return cliente;
                        });
                        this.estados = response.data.status;
                    });
                },
                verificarPedidosPendientes: function() {
                    console.log("Ejecutando verificación de pedidos pendientes.");
                    const pedidosPendientes = this.pedidos.filter(pedido => pedido.status.name === 'Pendiente');
                    console.log("Pedidos pendientes: ", pedidosPendientes);
                    if (pedidosPendientes.length > 0) {
                        Swal.fire({
                            title: 'Atención',
                            text: `Tienes ${pedidosPendientes.length} pedido(s) pendiente(s).`,
                            icon: 'warning',
                            confirmButtonText: 'Ver ahora'
                        });
                    }
                },
                crear: function() {
                    let parametros = {
                        customer_id: this.pedido.customer_id,
                        date: this.pedido.date,
                        quantity: this.pedido.quantity,
                        address: this.pedido.address,
                        statu_id: this.pedido.statu_id
                    };
                    axios.post(url, parametros)
                        .then(response => {
                            this.mostrar();
                        });

                    this.pedido.customer_id = "";
                    this.pedido.date = "";
                    this.pedido.quantity = "";
                    this.pedido.address = "";
                    this.pedido.statu_id = "";

                },
                editar: function() {
                    let parametros = {
                        customer_id: this.pedido.customer_id,
                        date: this.pedido.date,
                        quantity: this.pedido.quantity,
                        address: this.pedido.address,
                        statu_id: this.pedido.statu_id,
                        id: this.pedido.id
                    };
                    //console.log(parametros);
                    axios.put(url + this.pedido.id, parametros)
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
                    this.pedido = {
                        id: null,
                        customer_id: '',
                        date: '',
                        quantity: '',
                        address: '',
                        statu_id: ''
                    };
                },
                formEditar: function(id, customer_id, date, quantity, address, statu_id) {
                    this.pedido.id = id;
                    this.pedido.customer_id = customer_id;
                    this.pedido.date = date;
                    this.pedido.quantity = quantity;
                    this.pedido.address = address;
                    this.pedido.statu_id = statu_id;

                    this.dialog = true;
                    this.operacion = 'editar';
                }
            }
        });
    </script>
</body>

</html>