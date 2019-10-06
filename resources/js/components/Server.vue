<template>
    <div class="container">
    
    
    
        <div class="row justify-content-center">
    
    
    
            <div class="col-md-12">
    
    
    
                <div class="card">
    
    
    
                    <div class="card-header">
    
    
    
                        Servidores
    
    
    
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
    
                                      <a @click="editServer(props.row)" href="#"><i class="fas fa-edit"></i></a>     
    
                                      <a href="#" @click="deleteServer(props.row.id)"><i class="fas fa-trash-alt"></i></a>
    
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
    
                        <h4 class="modal-title">Nuevo Servidor</h4>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="addServers()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Nombre</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('name')}" v-model="form.name" type="text" name="name" class="form-control" required>
    
                                        <has-error :form="form" field="name"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Proveedor</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('provider')}" v-model="form.provider" type="text" name="provider" class="form-control" required>
    
                                        <has-error :form="form" field="provider"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de Contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('start_contract')}" v-model="form.start_contract" type="date" name="start_contract" class="form-control" required>
    
                                        <has-error :form="form" field="start_contract"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Periodo</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('period')}" v-model="form.period" type="number" name="period" class="form-control" required>
    
                                        <has-error :form="form" field="period"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Capacidad (Gb)</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('storage')}" v-model="form.storage" type="number" name="storage" class="form-control" required>
    
                                        <has-error :form="form" field="storage"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Ram</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('ram')}" v-model="form.ram" type="number" name="ram" class="form-control" required>
    
                                        <has-error :form="form" field="ram"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Cores</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('cores')}" v-model="form.cores" type="number" name="cores" class="form-control" required>
    
                                        <has-error :form="form" field="cores"></has-error>
    
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
    
                        <h4 class="modal-title">Editar Servidor</h4>
    
                        <button v-on:click="clean" type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="updateServers()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Nombre</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('name')}" v-model="form.name" type="text" name="name" class="form-control" required>
    
                                        <has-error :form="form" field="name"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Proveedor</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('provider')}" v-model="form.provider" type="text" name="provider" class="form-control" required>
    
                                        <has-error :form="form" field="provider"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de Contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('start_contract')}" v-model="form.start_contract" type="date" name="start_contract" class="form-control" required>
    
                                        <has-error :form="form" field="start_contract"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Periodo</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('period')}" v-model="form.period" type="number" name="period" class="form-control" required>
    
                                        <has-error :form="form" field="period"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Capacidad (Gb)</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('storage')}" v-model="form.storage" type="number" name="storage" class="form-control" required>
    
                                        <has-error :form="form" field="storage"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Ram</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('ram')}" v-model="form.ram" type="number" name="ram" class="form-control" required>
    
                                        <has-error :form="form" field="ram"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Cores</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('cores')}" v-model="form.cores" type="number" name="cores" class="form-control" required>
    
                                        <has-error :form="form" field="cores"></has-error>
    
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
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';


export default {
    mounted() {
        this.getServers();

    },
    data() {
        return {
            servers: {},
            form: new Form({
                id: '',
                name: '',
                provider: '',
                start_contract: '',
                period: '',
                storage: '',
                ram: '',
                cores: ''
            }),
            columns: [{
                    label: 'Nombre',
                    field: 'name',
                },
                {
                    label: 'Provider',
                    field: 'provider',
                },
                {
                    label: 'Fecha Contrato',
                    field: 'start_contract',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                },
                {
                    label: 'Periodo',
                    field: 'period',
                    type: 'number',
                }, {
                    label: 'Capacidad',
                    field: 'storage',
                    type: 'number',
                }, {
                    label: 'Ram',
                    field: 'ram',
                    type: 'number',
                }, {
                    label: 'Cores',
                    field: 'cores',
                    type: 'number',
                }, {
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
        editServer(server) {
            $('#editmodal').modal('show')
            this.form.fill(server);
        },

        deleteServer(id) {
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
                    this.form.delete('servers/' + id).then(() => {
                        swal.fire("Eliminado!", "", "success");
                        this.getServers();
                    }).catch(() => {
                        swal("WOW!", "Algo ha ocurrido.", "warning");
                    })
                }
            })
        },
        getServers() {
            let urlServers = "servers";
            axios.get(urlServers).then(response => {
                this.rows = response.data;
            });
        },
        addServers() {
            this.form.post('servers')
                .then(() => {
                    $('#modal').modal('hide');
                    this.getServers();

                    Toast.fire({
                        type: 'success',
                        title: 'Creado con exito!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        },
        reload() {
            this.getServers();
            Toast.fire({
                type: 'success',
                title: 'Registros actualizados!'
            })
        },
        clean() {
            this.form.reset();
        },
        updateServers() {
            this.form.put('servers/' + this.form.id)
                .then(() => {
                    $('#editmodal').modal('hide')
                    this.getServers();
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
