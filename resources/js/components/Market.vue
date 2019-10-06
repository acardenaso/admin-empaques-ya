<template>
    <div class="container">
    
    
    
    
    
    
    
        <div class="row justify-content-center">
    
    
    
    
    
    
    
            <div class="col-md-12">
    
    
    
    
    
    
    
                <div class="card">
    
    
    
    
    
    
    
                    <div class="card-header">
    
    
    
    
    
    
    
                        Supermercados
    
    
    
    
    
    
    
                        <div class="card-tools">
    
    
    
    
    
    
    
                            <button data-toggle="modal" data-target="#modal" type="button" class="btn btn-block btn-outline-primary">Nuevo Servidor</button>
    
    
    
    
    
    
    
                        </div>
    
    
    
    
    
    
    
                        <button v-on:click="reload" type="button" class="btn-sm btn btn-outline-primary"><i class="fas fa-sync-alt"></i></button>
    
    
    
    
    
    
    
                    </div>
    
    
    
    
    
    
    
                    <div class="card-body table-responsive p-0">
    
    
    
    
    
    
    
                        <div>
    
    
    
    
    
    
    
                            <vue-good-table :columns="columns" :rows="rows" :pagination-options="{
    
        
    
                                        enabled: true,
    
        
    
                                        mode: 'records',
    
        
    
                                        perPage: 5,
    
        
    
                                        position: 'top',
    
        
    
                                        perPageDropdown: [3, 7, 9],
    
        
    
                                        dropdownAllowAll: false,
    
        
    
                                        setCurrentPage: 2,
    
        
    
                                        nextLabel: 'Siguiente',
    
        
    
                                        prevLabel: 'Antes',
    
        
    
                                        rowsPerPageLabel: 'Datos por pagina',
    
        
    
                                        ofLabel: 'de',
    
        
    
                                        pageLabel: 'page', // for 'pages' mode
    
        
    
                                        allLabel: 'All',                           
    
        
    
                                        }" :search-options="{
    
        
    
                                        enabled: true,
    
        
    
                                        skipDiacritics: true,
    
        
    
                                        placeholder: 'Buscar en la tabla',
    
        
    
                                        }">
    
    
    
                                <template slot="table-row" slot-scope="props">
    
        
    
                                        <div v-if="props.column.field=='actions'">
    
        
    
                                          <a @click="editMarket(props.row)" href="#"><i class="fas fa-edit"></i></a>     
    
        
    
                                          <a href="#" @click="deleteMarket(props.row.id)"><i class="fas fa-trash-alt"></i></a>
    
        
    
                                        </div>
</template>
                                </vue-good-table>
                                
                        </div>
    
    
    
    
    
                    </div>
    
                    <div class="card-footer">
    
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
        <div class="modal" id="modal">
    
            <div class="modal-dialog">
    
                <div class="modal-content bg-default">
    
                    <div class="modal-header">
    
                        <h4 class="modal-title">Nuevo Supermercado</h4>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="addMarkets()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Comuna</label>
    
                                    <div class="form-group">
                                        <select  name="commune_id" class="form-control" v-model="form.commune_id">  
                                             <option  v-for="commune in communes" :value="commune.id" :key="commune.id">
                                                 {{commune.name}}
                                                 </option>   
                                         </select required>
                                        <has-error :form="form" field="commune_id"></has-error>
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Nombre de supermercado</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('name')}" v-model="form.name" type="text" name="name" class="form-control" required>
    
                                        <has-error :form="form" field="name"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Direccion</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('address')}" v-model="form.address" type="text" name="address" class="form-control" required>
    
                                        <has-error :form="form" field="address"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Maximo de empaques</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('max_packing')}" v-model="form.max_packing" type="number" name="max_packing" class="form-control" required>
    
                                        <has-error :form="form" field="max_packing"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de pago</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('payment_day')}" v-model="form.payment_day" type="date" name="payment_day" class="form-control" required>
    
                                        <has-error :form="form" field="payment_day"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
                        <div class="modal-footer justify-content-between">
    
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Salir</button>
    
                            <button type="submit" class="btn btn-primary">Guardar</button>
    
                        </div>
    
                    </form>
    
                </div>
    
                <!-- /.modal-content -->
    
            </div>
    
            <!-- /.modal-dialog -->
    
        </div>
    
    
    
        <div class="modal" id="editmodal">
    
            <div class="modal-dialog">
    
                <div class="modal-content bg-default">
    
                    <div class="modal-header">
    
                        <h4 class="modal-title">Editar Supermercado</h4>
    
                        <button v-on:click="clean" type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="updateMarkets()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Comuna</label>
    
                                    <div class="form-group">
    
                                        <select  name="commune_id" class="form-control" v-model="form.commune_id">  
                                             <option  v-for="commune in communes" :value="commune.id" :key="commune.id">
                                                 {{commune.name}}
                                                 </option>   
                                         </select required>
    
                                        <has-error :form="form" field="commune_id"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Nombre</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('name')}" v-model="form.name" type="text" name="name" class="form-control" required>
    
                                        <has-error :form="form" field="name"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Direccion</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('address')}" v-model="form.address" type="text" name="address" class="form-control" required>
    
                                        <has-error :form="form" field="address"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Maximo empaques</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('max_packing')}" v-model="form.max_packing" type="number" name="max_packing" class="form-control" required>
    
                                        <has-error :form="form" field="max_packing"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de pago</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('payment_day')}" v-model="form.payment_day" type="date" name="payment_day" class="form-control" required>
    
                                        <has-error :form="form" field="payment_day"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                        </div>
    
                        <div class="modal-footer justify-content-between">
    
                            <button type="submit" class="btn btn-primary">Actualizar</button>
    
                        </div>
    
                    </form>
    
                </div>
    
                <!-- /.modal-content -->
    
            </div>
    
            <!-- /.modal-dialog -->
    
        </div>
    
    </div>
</template>

<script>

import { VueGoodTable } from 'vue-good-table';


export default {
    mounted() {
        this.getMarkets();
        this.getCommunes();
    },
    data() {
        return {
            communes: {},
            markets: {},
            form: new Form({
                id: '',
                commune_id:'',
                name: '',
                address: '',
                max_packing: '',
                payment_day: ''
            }),
            columns: [{
                    label: 'Comuna',
                    field: 'commune.name',
                },
                {
                    label: 'Supermercado',
                    field: 'name',
                },
                {
                    label: 'Direccion',
                    field: 'address',
                },
                {
                    label: 'Max. empaques',
                    field: 'max_packing',
                    type: 'number',
                },
                {
                    label: 'Fecha de pago',
                    field: 'payment_day',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                    type: 'date',
                },
                {
                    label: 'Acciones',
                    field: 'actions',
                    html: true,

                },
            ],
            
            rows: [

            ],
        }
    },

    components: {
        VueGoodTable,
    },
    methods: {
        editMarket(market) {
            $('#editmodal').modal('show')
            this.form.fill(market);
        },

        deleteMarket(id) {
            swal.fire({
                title: 'Estas seguro?',
                text: "No podrás revertirlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('markets/' + id).then(() => {
                        swal.fire("Eliminado!", "", "success");
                        this.getMarkets();
                    }).catch(() => {
                        swal("WOW!", "Algo ha ocurrido.", "warning");
                    })
                }
            })
        },
        getMarkets() {
            let urlMarkets = "markets";
            axios.get(urlMarkets).then(response => {
                this.rows = response.data;
            });
        },
           getCommunes() {
            let urlCommunes = "communes";
            axios.get(urlCommunes).then(response => {
              this.communes = response.data;    
            });
        },
        addMarkets() {
            this.form.post('markets')
                .then(() => {
                    $('#modal').modal('hide');
                       this.getMarkets();
                    Toast.fire({
                        type: 'success',
                        title: 'Creado con exito!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        },
        reload() {
            this.getMarkets();
            Toast.fire({
                type: 'success',
                title: 'Registros actualizados!'
            })
        },
        clean() {
            this.form.reset();
        },
        updateMarkets() {
            this.form.put('markets/' + this.form.id)
                .then(() => {
                    $('#editmodal').modal('hide')
                    this.getMarkets();
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio realizado!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        }
    }
}
</script>
