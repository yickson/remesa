<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de tasas</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <b-table striped hover :items="tableData"></b-table>
                </div>
            </div>
        </div>
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
            }
        },
        methods: {
            getRates() {
                axios.get('list_rates')
                    .then(response => {
                        this.tableData = response.data.data;
                    })
                    .catch(e => console.log(e))
            }
        }
    }
</script>