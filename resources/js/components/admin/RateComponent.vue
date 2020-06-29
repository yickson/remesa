<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de tasas</h3>
                    <div class="card-tools">
                        <b-button variant="primary" class="btn btn-primary float-right" v-b-modal.modal-1>Crear tasa de cambio</b-button>
                    </div>
                </div>
                <div class="card-body">
                    <b-table striped hover :items="tableData"></b-table>
                </div>
            </div>
        </div>
        <!-- Modal para crear tasa de cambio -->
        <b-modal cancel-title="Cancelar" ok-title="Crear" @ok="handleOk" id="modal-1" title="Ingresa la tasa de cambio">
            <b-form @submit.stop.prevent="createRate" v-if="show">
                <b-form-group
                        id="input-group-1"
                        label="Tasa de cambio"
                        label-for="input-1"
                >
                    <b-form-input
                            id="input-1"
                            v-model="rate"
                            type="text"
                            required
                            placeholder="Ingresar tasa de cambio"
                    ></b-form-input>
                </b-form-group>
            </b-form>
        </b-modal>
        <notifications group="rate" />
    </div>
</template>
<script>
    export default {
        mounted() {
            this.getRates();
        },
        data() {
            return {
                tableData: [],
                show: true,
                rate: ''
            }
        },
        methods: {
            getRates() {
                axios.get('list_rates')
                    .then(response => {
                        this.tableData = response.data.data;
                    })
                    .catch(e => console.log(e))
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.createRate()
            },
            createRate() {
                axios.post('create_rate', {'rate':this.rate})
                .then(response => {
                    this.$bvModal.hide('modal-1');
                    if(response.data.message) {
                        this.$notify({
                            group: 'rate',
                            title: 'Tasa de cambio creada',
                            text: '¡Ha sido creada exitosamente!'
                        });
                    }
                })
                .catch(error => console.error(error))
            }
        }
    }
</script>