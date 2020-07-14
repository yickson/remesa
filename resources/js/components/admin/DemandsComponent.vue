<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de solicitudes</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <b-table
                            responsive
                            bordered hover
                            :fields="fields"
                            :items="tableData"
                            id="my-table"
                            :per-page="perPage"
                            :current-page="currentPage"
                    >
                        <template v-slot:cell(actions)="item">
                            <template v-if="item.item.estatus === 'Iniciando'">
                                <b-button size="sm" @click="info(item.item)" v-b-modal.modal-1 class="mr-1" variant="primary">Informar pago</b-button>
                            </template>
                        </template>
                    </b-table>
                </div>
                <div class="card-footer">
                    <b-pagination
                            pills
                            v-model="currentPage"
                            :total-rows="rows"
                            :per-page="perPage"
                            aria-controls="my-table"
                    ></b-pagination>
                </div>
            </div>
        </div>
        <b-modal id="modal-1" title="Realizar transferencia" ok-only @ok="handleOk" ok-title="Informar pago">
            <b-list-group>
                <b-list-group-item>Localizador: {{ item.localizador }}</b-list-group-item>
                <b-list-group-item>Monto: {{ item.monto }}</b-list-group-item>
                <b-list-group-item>Banco: {{ item.banco }}</b-list-group-item>
                <b-list-group-item>Cedula: {{ item.cedula }}</b-list-group-item>
                <b-list-group-item>Nombre: {{ item.nombre }}</b-list-group-item>
                <b-list-group-item>Cuenta: {{ item.cuenta }}</b-list-group-item>
                <b-list-group-item>Estatus: {{ item.estatus }}</b-list-group-item>
            </b-list-group>
            <hr>
            <b-list-group>
                <b-list-group-item>Datos para transferencia</b-list-group-item>
                <b-list-group-item>Banco de Chile</b-list-group-item>
                <b-list-group-item>Cuenta corriente</b-list-group-item>
                <b-list-group-item>8317118</b-list-group-item>
                <b-list-group-item>Yickson Ramírez</b-list-group-item>
                <b-list-group-item>25.101.505-8</b-list-group-item>
                <b-list-group-item>Si tu banco no genera un número de referencia, colocar el rut de la cuenta proveniente.</b-list-group-item>
            </b-list-group>
            <b-form @submit.stop.prevent="makeDeposit" v-if="show">
                <b-form-group
                        id="input-group-1"
                        label="Número de referencia"
                        label-for="input-1"
                >
                    <b-form-input
                            id="input-1"
                            v-model="transfer.reference"
                            type="text"
                            required
                            placeholder="Ingresar número de referencia"
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                        id="input-group-2"
                        label="Monto a transferir"
                        label-for="input-2"
                >
                    <b-form-input
                            id="input-2"
                            v-model="transfer.amount"
                            type="text"
                            required
                            placeholder="Ingresar monto transferido"
                    ></b-form-input>
                </b-form-group>
            </b-form>
        </b-modal>
        <notifications group="transfer" />
    </div>
</template>

<script>
    export default {
        name: 'demands-component',
        mounted() {
            this.getOrders();
        },
        data() {
            return {
                show:true,
                currentPage: 1,
                perPage: 10,
                fields: [
                    { key: 'localizador', label: 'Localizador'},
                    { key: 'monto', label: 'Monto'},
                    { key: 'tasa', label: 'Tasa'},
                    { key: 'banco', label: 'Banco', sortable: true},
                    { key: 'fecha', label: 'Fecha', sortable: true},
                    { key: 'cedula', label: 'Cedula'},
                    { key: 'nombre', label: 'Nombre'},
                    { key: 'cuenta', label: 'Cuenta'},
                    { key: 'estatus', label: 'Estatus', sortable: true},
                    { key: 'actions', label: 'Acciones' }
                ],
                tableData: [],
                item: {},
                transfer: {
                    amount: '',
                    reference: '',
                    user: '',
                    order: ''
                }
            }
        },
        methods: {
            getOrders() {
                axios.get('list_demands')
                    .then(response => {
                        this.tableData = response.data.data;
                    })
                    .catch(e => console.log(e))
            },
            info(item) {
              this.item = item;
              if (item.estatus !== 'Iniciando') {
                  this.show = false
              } else {
                  this.transfer.order = item.id;
                  this.transfer.user = item.user;
              }
            },
            handleOk (bvModalEvt) {
                bvModalEvt.preventDefault()
                this.makeTransfer()
            },
            makeTransfer() {
                axios.post('transfer', this.transfer)
                    .then(response => {
                        this.$bvModal.hide('modal-1');
                        if(response.data.message) {
                            this.$notify({
                                group: 'transfer',
                                title: 'Transferencia',
                                text: '¡Ha sido creada exitosamente!'
                            });
                            this.transfer.amount = '';
                            this.transfer.reference = '';
                            this.getOrders();
                        } else {
                            this.$notify({
                                group: 'transfer',
                                title: 'Transferencia',
                                text: response.data.error,
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => console.error(error))
            }
        },
        computed: {
            rows() {
                return this.tableData.length
            }
        }
    }
</script>