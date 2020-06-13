<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de mis solicitudes</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordenes" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Localizador</th>
                                <th>Monto</th>
                                <th>Banco</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Cuenta</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                            <tr v-for="order in orders">
                                <td>{{ order.locator }}</td>
                                <td>{{ order.amount }}</td>
                                <td>{{ order.bank }}</td>
                                <td>{{ order.name }}</td>
                                <td>{{ order.identification }}</td>
                                <td>{{ order.number }}</td>
                                <td>{{ order.date }}</td>
                                <td>{{ order.status }}</td>
                                <td> - </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DemandsComponent",
        data() {
            return {
               orders: []
            }
        },
        methods:{
            getOrders() {
                axios.get('list_demands').
                then(response => {
                    this.orders = response.data.data;
                }).
                catch( e => console.log(e))
            }
        },
        mounted() {
            this.getOrders();
        }
    }
</script>

<style scoped>

</style>