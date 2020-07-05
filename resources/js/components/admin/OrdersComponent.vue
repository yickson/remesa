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
                            <b-btn size="sm" @click="info(item.item)" v-b-modal.modal-1 class="mr-1">Details</b-btn>
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
        <b-modal id="modal-1" title="Realizar transferencia" ok-only ok-title="Transferencia hecha">
            <b-list-group>
                <b-list-group-item>Localizador: {{ item.localizador }}</b-list-group-item>
                <b-list-group-item>Monto: {{ item.monto }}</b-list-group-item>
                <b-list-group-item>Banco: {{ item.banco }}</b-list-group-item>
                <b-list-group-item>Cedula: {{ item.cedula }}</b-list-group-item>
                <b-list-group-item>Nombre: {{ item.nombre }}</b-list-group-item>
                <b-list-group-item>Cuenta: {{ item.cuenta }}</b-list-group-item>
                <b-list-group-item>Estatus: {{ item.estatus }}</b-list-group-item>
            </b-list-group>
            <b-form @submit.stop.prevent="changeStatus" v-if="show">
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
                <input type="hidden" :value="item.id">
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
                    { key: 'monto', label: 'AMonto'},
                    { key: 'banco', label: 'Banco'},
                    { key: 'fecha', label: 'Fecha'},
                    { key: 'cedula', label: 'Cedula'},
                    { key: 'nombre', label: 'Nombre'},
                    { key: 'cuenta', label: 'Cuenta'},
                    { key: 'estatus', label: 'Estatus'},
                    { key: 'actions', label: 'Acciones' }
                ],
                item: {},
                deposit: {
                    reference: '',
                    amount: ''
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
                console.log(item);
                this.item = item;
            },
            handleOk(bvModalEvt) {
                bvModalEvt.preventDefault()
                this.changeStatus()
            },
            changeStatus() {
                axios.post('change_status', {'rate':this.rate})
                    .then(response => {
                        this.$bvModal.hide('modal-1');
                        if(response.data.message) {
                            this.$notify({
                                group: 'orders',
                                title: 'Tasa de cambio creada',
                                text: '¡Ha sido creada exitosamente!'
                            });
                        }
                    })
                    .catch(error => console.error(error))
            }
        },
        computed: {
            rows() {
                return this.items.length
            }
        }
    }
</script>