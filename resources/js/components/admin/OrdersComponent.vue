<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de ordenes</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <b-table
                            bordered hover
                            :fields="fields"
                            :items="items"
                            id="my-table"
                            :per-page="perPage"
                            :current-page="currentPage"
                    >
                        <template v-slot:cell(actions)="item">
                            <template v-if="item.item.estatus !== 'Finalizada'">
                                <b-button size="sm" @click="info(item.item)" v-b-modal.modal-1 class="mr-1" variant="primary">Transferir</b-button>
                            </template>
                            <template v-if="item.item.estatus === 'Iniciando'">
                                <b-button size="sm" variant="success" @click="validateOrder(item.item.id)"><i class="fa fa-check" aria-hidden="true"></i></b-button>
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
        <b-modal id="modal-1" title="Realizar transferencia" ok-only @ok="handleOk" ok-title="Transferencia hecha">
            <b-list-group>
                <b-list-group-item>Localizador: {{ item.localizador }}</b-list-group-item>
                <b-list-group-item>Monto: {{ item.monto }}</b-list-group-item>
                <b-list-group-item>Banco: {{ item.banco }}</b-list-group-item>
                <b-list-group-item>Cedula: {{ item.cedula }}</b-list-group-item>
                <b-list-group-item>Nombre: {{ item.nombre }}</b-list-group-item>
                <b-list-group-item>Cuenta: {{ item.cuenta }}</b-list-group-item>
                <b-list-group-item>Estatus: {{ item.estatus }}</b-list-group-item>
            </b-list-group>
            <b-form @submit.stop.prevent="makeDeposit" v-if="show">
                <b-form-group
                        id="input-group-1"
                        label="Número de referencia"
                        label-for="input-1"
                >
                    <b-form-input
                            id="input-1"
                            v-model="deposit.reference"
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
                            v-model="deposit.amount"
                            type="text"
                            required
                            placeholder="Ingresar monto transferido"
                    ></b-form-input>
                </b-form-group>
            </b-form>
        </b-modal>
        <notifications group="orders" />
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
                items: [],
                fields: [
                    { key: 'localizador', label: 'Localizador'},
                    { key: 'monto', label: 'Monto'},
                    { key: 'banco', label: 'Banco', sortable: true},
                    { key: 'fecha', label: 'Fecha', sortable: true},
                    { key: 'cedula', label: 'Cedula'},
                    { key: 'nombre', label: 'Nombre'},
                    { key: 'cuenta', label: 'Cuenta'},
                    { key: 'estatus', label: 'Estatus', sortable: true},
                    { key: 'actions', label: 'Acciones' }
                ],
                item: {},
                deposit: {
                    reference: '',
                    amount: '',
                    user: '',
                    order: ''
                }
            }
        },
        methods: {
            getOrders() {
                axios.get('list_demands')
                    .then(response => {
                        this.items = response.data.data;
                    })
                    .catch(e => console.log(e))
            },
            info(item) {
                this.item = item;
                if (item.estatus === 'Finalizada') {
                    this.show = false;
                } else {
                    this.show = true;
                    this.deposit.user = item.user;
                    this.deposit.order = item.id;
                }

            },
            handleOk(bvModalEvt) {
                bvModalEvt.preventDefault()
                this.makeDeposit()
            },
            makeDeposit() {
                axios.post('deposit', this.deposit)
                    .then(response => {
                        this.$bvModal.hide('modal-1');
                        if(response.data.message) {
                            this.$notify({
                                group: 'orders',
                                title: 'Transferencia',
                                text: '¡Ha sido creada exitosamente!'
                            });
                            this.deposit.amount = '';
                            this.deposit.reference = '';
                            this.getOrders();
                        } else {
                            this.$notify({
                                group: 'orders',
                                title: 'Transferencia',
                                text: 'Error al realizar la transferencia',
                                type: 'error'
                            })
                        }
                    })
                    .catch(error => console.error(error))
            },
            validateOrder(id) {
                this.$bvModal.msgBoxConfirm('Una vez hecho esto, es irreversible', {
                    title: '¿Estás seguro de validar esta orden?',
                    size: 'md',
                    buttonSize: 'md',
                    okVariant: 'danger',
                    okTitle: 'Si',
                    cancelTitle: 'No',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: true
                })
                    .then(value => {
                        if(value) {
                            axios.get(`validate/${id}`)
                                .then(response => {
                                    if(response.data.message) {
                                        this.$notify({
                                            group: 'orders',
                                            title: 'Orden modificada',
                                            text: '¡Ha sido validada exitosamente!'
                                        });
                                        this.getOrders();
                                    } else {
                                        this.$swal(
                                            'Error',
                                            'Orden de cambio no existe',
                                            'error'
                                        )
                                    }
                                })
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
        },
        computed: {
            rows() {
                return this.items.length
            }
        }
    }
</script>