<template>
    <v-client-table :data="tableData" :columns="columns" :options="options">

    </v-client-table>
</template>

<script>
    export default {
        mounted() {
            this.getOrders();
        },
        data() {
            return {
                columns: [
                    'localizador',
                    'monto',
                    'banco',
                    'nombre',
                    'cedula',
                    'cuenta',
                    'fecha',
                    'estatus'
                ],
                tableData: [],
                options:{
                    filterByColumn: true,
                    perPage:10,
                    texts: {
                        filter: "Filtrar:",
                        filterBy: 'Filtrar por {column}',
                        count:' '
                    },
                    dateColumns:['fecha'],
                    dateFormat: 'DD-MM-YYYY',
                    datepickerOptions: {
                        showDropdowns: true,
                        autoUpdateInput: true,
                    },
                    pagination: { chunk:10,dropdown:false },
                    filterable:['localizador', 'nombre', 'cedula', 'estatus'],
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
            }
        }
    }
</script>

<style scoped>

</style>