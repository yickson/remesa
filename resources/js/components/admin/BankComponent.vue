<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de bancos</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="bancos" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Prefijo</th>
                            </tr>
                            </thead>
                            <tr v-for="bank in banks">
                                <td>{{ bank.id }}</td>
                                <td>{{ bank.name }}</td>
                                <td>{{ bank.prefix }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    import { banksMixin } from '../mixins/banksMixin';
    export default {
        name: "BankComponent",
        data() {
            return {

            }
        },
        mixins: [banksMixin]
    }
</script>

<style scoped>

</style>