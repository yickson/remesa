<template>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitar remesa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <b-form @submit="createDemand" v-if="show">
                        <b-form-group id="input-group-1" label="Cuentas bancarias" label-for="input-1">
                            <b-form-select
                                    value=""
                                    id="input-1"
                                    v-model="form.account"
                                    :options="listAccounts"
                                    value-field="id"
                                    text-field="fullAccount"
                                    required
                            >
                                <option value="">Por favor seleccione una cuenta</option>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group id="input-group-2" label="Monto a enviar" label-for="input-2">
                            <b-form-input
                                    id="input-2"
                                    v-model.number="form.amount"
                                    required
                                    placeholder="20000"
                            ></b-form-input>
                        </b-form-group>
                        <b-button type="submit" variant="primary">Solicitar</b-button>
                    </b-form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <rate-component></rate-component>
        <notifications group="demand" />
    </div>
</template>

<script>
    export default {
        template: 'demand-component',
        mounted() {
            this.listAccountBanks();
        },
        data() {
            return {
                listAccounts: [],
                form: {
                    account: '',
                    amount: 20000,
                },
                amountRate: 20000,
                rate: '',
                show: true
            }
        },
        methods: {
          listAccountBanks() {
              axios.get('get_accounts')
                  .then(response => {
                      let accounts = response.data.data;
                      this.listAccounts = accounts.map(this.getFullAccount);
                  })
                  .catch(e => console.log(e))
          },
          getFullAccount(item) {
              let data = {
                  'id': '',
                  'fullAccount': ''
              };
              data.id = item.id;
              data.fullAccount = [item.name, item.number].join(" - ");
              return data;
          },
          createDemand(e) {
              e.preventDefault();
              axios.post('create_demand', this.form)
                .then(response => {
                    if(response.data.data) {
                        this.$notify({
                            group: 'demand',
                            title: 'Solicitud',
                            text: 'Solicitud creada exitosamente'
                        });
                        setTimeout(() => {
                            location.href = "/admin/demands";
                        }, 2500);
                    } else {
                        this.$notify({
                            group: 'demand',
                            title: 'Solicitud',
                            text: 'Solicitud creada exitosamente',
                            type: 'error'
                        });
                    }
                })
          },
          getRateExchange() {
              axios.get('rate')
              .then(response => this.rate = response.data.data)
          }
        },
        name: "DemandComponent"
    }
</script>

<style scoped>

</style>