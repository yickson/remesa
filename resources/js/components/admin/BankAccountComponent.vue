<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de mis cuentas bancarias</h3>
                    <div class="card-tools">
                        <b-button class="btn btn-primary float-right" v-b-modal.modal-1>Crear cuenta bancaria</b-button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordenes" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Banco</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Cuenta</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                            <tr v-for="listAccount in listAccounts">
                                <th>{{ listAccount.bank }}</th>
                                <th>{{ listAccount.name }}</th>
                                <th>{{ listAccount.identification }}</th>
                                <th>{{ listAccount.number}}</th>
                                <th>{{ listAccount.date}}</th>
                                <th>
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger" @click="deleteAccountBank(listAccount.id)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- Modal -->
        <b-modal id="modal-1" title="Ingresa la cuenta bancaria">
            <b-form @submit="createAccountBank" @reset="onReset" v-if="show">
                <b-form-group
                        id="input-group-1"
                        label="Nombre de titular"
                        label-for="input-1"
                >
                    <b-form-input
                            id="input-1"
                            v-model="form.nameAccount"
                            type="text"
                            required
                            placeholder="Ingresar nombre titular"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-2" label="Número de cuenta" label-for="input-2">
                    <b-form-input
                            id="input-2"
                            v-model="form.numberAccount"
                            required
                            placeholder="Número de cuenta"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-3" label="Cédula de identidad" label-for="input-3">
                    <b-form-input
                            id="input-3"
                            v-model="form.dniAccount"
                            required
                            placeholder="Número de cédula"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-4" label="Bancos" label-for="input-4">
                    <b-form-select
                            id="input-4"
                            v-model="form.bank"
                            :options="banks"
                            value-field="id"
                            text-field="name"
                            required
                    ></b-form-select>
                </b-form-group>

                <b-button type="submit" variant="primary">Crear cuenta bancaria</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-modal>
        <notifications group="bankAccount" />
    </div>

</template>

<script>
    export default {
        template: 'bank-account-component',
        mounted: function() {
          this.listBanks();
          this.listAccountBanks();
        },
        data(){
            return {
                listAccounts: [],
                banks: [],
                bank: '',
                numberAccount: '',
                nameAccount: '',
                dniAccount: '',
                show: true,
                form: {
                    bank: '',
                    numberAccount: '',
                    nameAccount: '',
                    dniAccount: '',
                }
            };
        },
        methods:{
          createAccountBank(e) {
              e.preventDefault();
              let account = {
                bank: this.form.bank,
                numberAccount: this.form.numberAccount,
                nameAccount: this.form.nameAccount,
                dniAccount: this.form.dniAccount
              };
              axios.post('create_account', account)
                  .then(response => {
                      console.log(response.data);
                      if(response.data){
                          this.$bvModal.hide('modal-1');
                          this.$notify({
                              group: 'bankAccount',
                              title: 'Cuenta creada',
                              text: '¡Ha sido creada exitosamente!'
                          });
                          this.form.bank = '';
                          this.form.nameAccount = '';
                          this.form.numberAccount = '';
                          this.form.dniAccount = '';
                          this.listAccountBanks();
                      }
                  }).catch(e => console.log(e));
          },
          deleteAccountBank(id) {
              console.log(id);
              this.$swal({
                  title: '¿Estás seguro de borrar la cuenta bancaria?',
                  text: "Una vez hecho esto no se puede revertir",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, borrar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.value) {
                      axios.delete(`delete_account/${id}`)
                      .then(response => {
                          console.log(response.data);
                          if(response.data.response) {
                              this.$swal({
                                  title: 'Cuenta eliminada',
                                  text: 'De forma exitosa',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  timer: 1800,
                              })
                              this.listAccountBanks();
                          } else {
                              this.$swal(
                                  'Error',
                                  'Cuenta bancaria no existe',
                                  'error'
                              )
                          }
                      })

                  }
              })
          },
          listBanks() {
              axios.get('list_banks')
              .then(response => {
                  this.banks = response.data
              })
              .catch(e => console.log(e));
          },
          listAccountBanks() {
              axios.get('get_accounts')
              .then(response => {
                  this.listAccounts = response.data.data;
              })
              .catch(e => console.log(e))
          },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.bank = '';
                this.form.nameAccount = '';
                this.form.numberAccount = '';
                this.form.dniAccount = '';
                // Trick to reset/clear native browser form validation state
                this.show = false;
                this.$nextTick(() => {
                    this.show = true
                })
            }
        },
        name: "BankAccountComponent"
    }
</script>