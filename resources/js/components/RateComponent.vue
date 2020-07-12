<template>
        <div id="app" class="col-xs-12 col-sm-6 col-md-6">
            <div class="card">
                <div class="card-header">Calculadora en tiempo real</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Pesos chilenos a Bolívares</label>
                        <input v-validate="'min_value:20000'" v-model="money" class="form-control" type="number" data-vv-as="monto" name="min_value_field">
                    </div>
                    <div v-show="errors.all().length" >
                        <ul>
                            <li v-for="(error, i) in errors.all()">{{error}}</li>
                        </ul>
                    </div>
                    <p>
                        Dinero a recibir: {{ money * rate | currency }} - Monto de cambio: {{ money | currencyCLP}}
                    </p>
                </div>
            </div>
        </div>
</template>
<script>
    import {rateMixin} from "./mixins/rateMixin";
    export default {
        template: 'rate-component',
        data() {
            return {
                money: 30000
            }
        },
        filters: {
            currencyCLP: function (value) {
                return '$'+ new Intl.NumberFormat("es-CL").format(value);
            }
        },
        mixins: [rateMixin]
    }
</script>