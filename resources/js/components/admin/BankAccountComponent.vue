<template>
    <div class="row">
        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#createBankAccount">
            Crear cuenta bancaria
        </button>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de mis cuentas bancarias</h3>
                        </div>
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
                                <th>{{ listAccount.bank_id }}</th>
                                <th>{{ listAccount.name }}</th>
                                <th>{{ listAccount.identification }}</th>
                                <th>{{ listAccount.number}}</th>
                                <th>{{ listAccount.created_at}}</th>
                                <th> - </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="createBankAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ingresar cuenta bancaria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="callout callout-info">
                            <h5>Información importante</h5>
                            <p>Acá van los datos de la cuenta a la que se envía dinero en Venezuela.</p>
                        </div>
                        <form id="createAccountBank">
                            <div class="form-group">
                                <label for="bankId">Banco</label>
                                <select name="bankId" class="form-control" id="bankId" v-model="bank">
                                    <option v-for="banka in banks" :value="banka.id">{{banka.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="accountNumber">Número de cuenta</label>
                                <input type="text" class="form-control" id="accountNumber" v-model="numberAccount">
                            </div>
                            <div class="form-group">
                                <label for="accountName">Nombre titular de cuenta</label>
                                <input type="text" class="form-control" id="accountName" v-model="nameAccount">
                            </div>
                            <div class="form-group">
                                <label for="accountDNI">Cédula de identidad</label>
                                <input type="text" class="form-control" id="accountDNI" v-model="dniAccount">
                            </div>
                            <button class="btn btn-primary" @click="createAccountBank">Crear</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
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
            };
        },
        methods:{
          createAccountBank(e) {
              e.preventDefault();
              let account = {
                bank: this.bank,
                numberAccount: this.numberAccount,
                nameAccount: this.nameAccount,
                dniAccount: this.dniAccount
              };
              axios.post('create_account', account)
                  .then(response => {
                      if(response.data){
                          this.$swal({
                              title: 'Contacto',
                              text: 'Ha sido enviado correctamente.',
                              timer: 2000,
                              showCancelButton: false,
                              showConfirmButton: false
                          }).then(
                              function () {
                                  console.log(response);
                              },
                              function (dismiss) {
                                  if (dismiss === 'timer') {
                                      //console.log('I was closed by the timer')
                                  }
                              }
                          );
                          this.bank = '';
                          this.nameAccount = '';
                          this.numberAccount = '';
                          this.dniAccount = '';
                          this.listAccountBanks();
                      }
                  }).catch(e => console.log(e));
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
                  this.listAccounts = response.data;
              })
              .catch(e => console.log(e))
          }
        },
        name: "BankAccountComponent"
    }
</script>