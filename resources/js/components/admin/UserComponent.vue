<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de usuarios</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <b-table responsive striped hover :fields="fields" :items="tableData"></b-table>
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
    </div>
</template>

<script>
    export default {
        name: "UserComponent",
        mounted() {
            this.getUsers();
        },
        data() {
            return {
                fields: [
                    { key: 'id', label: 'Id'},
                    { key: 'name', label: 'Nombre'},
                    { key: 'email', label: 'Correo'},
                    { key: 'date', label: 'Fecha'}
                ],
                tableData: [],
                currentPage: 1,
                perPage: 10,
            }
        },
        methods: {
            getUsers() {
                axios.get('list_users')
                    .then(response => {
                        this.tableData = response.data.data;
                    })
                    .catch(e => console.log(e))
            }
        },
        computed: {
            rows() {
                return this.tableData.length
            }
        }

    }
</script>

<style scoped>

</style>