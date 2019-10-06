<template>
    <div class="container">
    
    
    
        <div class="row justify-content-center">
    
    
    
            <div class="col-md-12">
    
    
    
                <div class="card">
    
    
    
                    <div class="card-header">
    
    
    
                        Dominios
    
    
    
                        <div class="card-tools">
    
    
    
                            <button data-toggle="modal" data-target="#modal" type="button" class="btn btn-block btn-outline-primary">Nuevo Dominio</button>
    
    
    
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
    
                                      <a @click="editDomain(props.row)" href="#"><i class="fas fa-edit"></i></a>     
    
                                      <a href="#" @click="deleteDomain(props.row.id)"><i class="fas fa-trash-alt"></i></a>
    
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
    
                        <h4 class="modal-title">Nuevo Dominio</h4>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="addDomains()">
    
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
    
                                    <label>Ip (Direccion de red)</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('ip')}" v-model="form.ip" type="text" name="ip" class="form-control" required>
    
                                        <has-error :form="form" field="ip"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Geo dominio</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('geo_domain')}" v-model="form.geo_domain" type="text" name="geo_domain" class="form-control" required>
    
                                        <has-error :form="form" field="geo_domain"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('start_contract')}" v-model="form.start_contract" type="date" name="start_contract" class="form-control" required>
    
                                        <has-error :form="form" field="start_contract"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Tiempo de contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('years')}" v-model="form.years" type="number" name="years" class="form-control" required>
    
                                        <has-error :form="form" field="years"></has-error>
    
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
    
                        <h4 class="modal-title">Editar Dominio</h4>
    
                        <button v-on:click="clean" type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="updateDomains()">
    
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
    
                                    <label>Ip (direccion de red)</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('ip')}" v-model="form.ip" type="text" name="ip" class="form-control" required>
    
                                        <has-error :form="form" field="ip"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Geo dominio</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('geo_domain')}" v-model="form.geo_domain" type="text" name="geo_domain" class="form-control" required>
    
                                        <has-error :form="form" field="geo_domain"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('start_contract')}" v-model="form.start_contract" type="date" name="start_contract" class="form-control" required>
    
                                        <has-error :form="form" field="start_contract"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Tiempo de contrato</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('years')}" v-model="form.years" type="number" name="years" class="form-control" required>
    
                                        <has-error :form="form" field="years"></has-error>
    
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
        this.getDomains();

    },
    data() {
        return {
            servers: {},
            form: new Form({
                id: '',
                name: '',
                ip: '',
                geo_domain: '',
                start_contract: '',
                years: ''
            }),
            columns: [{
                    label: 'Nombre',
                    field: 'name',
                },
                {
                    label: 'Ip (Direccion de red)',
                    field: 'ip',
                },
                {
                    label: 'Geo dominio',
                    field: 'geo_domain',
                },
                {
                    label: 'Fecha de contrato',
                    field: 'start_contract',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                }, 
                {
                    label: 'Tiempo de contrato',
                    field: 'years',
                    type: 'number',
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
        editDomain(domain) {
            $('#editmodal').modal('show')
            this.form.fill(domain);
        },

        deleteDomain(id) {
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
                    this.form.delete('domains/' + id).then(() => {
                        swal.fire("Eliminado!", "", "success");
                        this.getDomains();
                    }).catch(() => {
                        swal("WOW!", "Algo ha ocurrido.", "warning");
                    })
                }
            })
        },
        getDomains() {
            let urlDoamins = "domains";
            axios.get(urlDoamins).then(response => {
                this.rows = response.data;
            });
        },
        addDomains() {
            this.form.post('domains')
                .then(() => {
                    this.form.reset();
                    $('#modal').modal('hide');
                    this.getDomains();

                    Toast.fire({
                        type: 'success',
                        title: 'Creado con exito!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        },
        reload() {
            this.getDomains();
            Toast.fire({
                type: 'success',
                title: 'Registros actualizados!'
            })
        },
        clean() {
            this.form.reset();
        },
        updateDomains() {
            this.form.put('domains/' + this.form.id)
                .then(() => {
                    $('#editmodal').modal('hide')
                    this.getDomains();
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
