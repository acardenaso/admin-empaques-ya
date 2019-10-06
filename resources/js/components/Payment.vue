<template>
    <div class="container">
    
    
    
    
    
    
    
        <div class="row justify-content-center">
    
    
    
    
    
    
    
            <div class="col-md-12">
    
    
    
    
    
    
    
                <div class="card">
    
    
    
    
    
    
    
                    <div class="card-header">
    
    
    
    
    
    
    
                        Pagos
    
    
    
    
    
    
    
                        <div class="card-tools">
    
    
    
    
    
    
    
                            <button data-toggle="modal" data-target="#modal" type="button" class="btn btn-block btn-outline-primary">Nuevo Pago</button>
    
    
    
    
    
    
    
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
    
        
    
                                          <a @click="editPayment(props.row)" href="#"><i class="fas fa-edit"></i></a>     
    
        
    
                                          <a href="#" @click="deletePayment(props.row.id)"><i class="fas fa-trash-alt"></i></a>
    
        
    
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
    
                        <h4 class="modal-title">Nuevo Pago</h4>
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="addPayments()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Seleccione supermercado</label>
    
                                    <div class="form-group">
                                        <select  name="market_id" class="form-control" v-model="form.market_id">  
                                             <option  v-for="market in markets" :value="market.id" :key="market.id">
                                                 {{market.name}}
                                                 </option>   
                                         </select required>
                                        <has-error :form="form" field="market_id"></has-error>
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de pago</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('pay_date')}" v-model="form.pay_date" type="date" name="pay_date" class="form-control" required>
    
                                        <has-error :form="form" field="pay_date"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Monto</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('pay_amount')}" v-model="form.pay_amount" type="number" name="pay_amount" class="form-control" required>
    
                                        <has-error :form="form" field="pay_amount"></has-error>
    
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
    
                        <h4 class="modal-title">Editar Pago</h4>
    
                        <button v-on:click="clean" type="button" class="close" data-dismiss="modal" aria-label="Close">
    
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
    
                    </div>
    
                    <form method="POST" @submit.prevent="updatePayments()">
    
                        <div class="modal-body">
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Supermercado</label>
    
                                    <div class="form-group">
    
                                        <select  name="market_id" class="form-control" v-model="form.market_id">  
                                             <option  v-for="market in markets" :value="market.id" :key="market.id">
                                                 {{market.name}}
                                                 </option>   
                                         </select required>
    
                                        <has-error :form="form" field="market_id"></has-error>
    
                                    </div>
    
                                </div>
    
                                <div class="col-sm-6">
    
                                    <label>Fecha de pago</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('pay_date')}" v-model="form.pay_date" type="date" name="pay_date" class="form-control" required>
    
                                        <has-error :form="form" field="pay_date"></has-error>
    
                                    </div>
    
                                </div>
    
                            </div>
    
                            <div class="row">
    
                                <div class="col-sm-6">
    
                                    <label>Monto</label>
    
                                    <div class="form-group">
    
                                        <input :class="{ 'is-invalid':form.errors.has('pay_amount')}" v-model="form.pay_amount" type="number" name="pay_amount" class="form-control" required>
    
                                        <has-error :form="form" field="pay_amount"></has-error>
    
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
        this.getPayments();
        this.getMarkets();
    },
    data() {
        return {
            markets: {},
            payments: {},
            form: new Form({
                id: '',
                market_id:'',
                pay_date: '',
                pay_amount: ''
            }),
            columns: [{
                    label: 'supermercado',
                    field: 'market.name',
                },
                {
                    label: 'Fecha de pago',
                    field: 'pay_date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'dd-MM-yyyy',
                },
                {
                    label: 'Monto',
                    field: 'pay_amount',
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
        editPayment(payment) {
            $('#editmodal').modal('show')
            this.form.fill(payment);
        },

        deletePayment(id) {
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
                    this.form.delete('payments/' + id).then(() => {
                        swal.fire("Eliminado!", "", "success");
                        this.getPayments();
                    }).catch(() => {
                        swal("WOW!", "Algo ha ocurrido.", "warning");
                    })
                }
            })
        },
        getPayments() {
            let urlPayments = "payments";
            axios.get(urlPayments).then(response => {
                this.rows = response.data;
            });
        },
           getMarkets() {
            let urlMarkets = "markets";
            axios.get(urlMarkets).then(response => {
              this.markets = response.data;    
            });
        },
        addPayments() {
            this.form.post('payments')
                .then(() => {
                    $('#modal').modal('hide');
                       this.getPayments();
                    Toast.fire({
                        type: 'success',
                        title: 'Creado con exito!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        },
        reload() {
            this.getPayments();
            Toast.fire({
                type: 'success',
                title: 'Registros actualizados!'
            })
        },
        clean() {
            this.form.reset();
        },
        updatePayments() {
            this.form.put('payments/' + this.form.id)
                .then(() => {
                    $('#editmodal').modal('hide')
                    this.getPayments();
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
