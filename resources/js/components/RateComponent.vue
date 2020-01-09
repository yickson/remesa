<template>
    <div class="row">
        <div class="col-6">
            <div class="card bg-light mb-3">
                <div class="card-header">La tasa de hoy</div>
                <div class="card-body">
                    <h4 class="card-title">{{ rate }}</h4>
                </div>
            </div>
        </div>
        <div id="app" class="col-6">
            <div class="card bg-light mb-3">
                <div class="card-header">Calculadora en tiempo real</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Pesos chilenos a Bolívares</label>
                        <input v-model="money" class="form-control" type="text">
                    </div>
                    <p id="total">
                        Dinero a recibir: {{ money * rate | currency }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        template: 'rate-component',
        data() {
            return {
                rate: '',
                money: 30000
            }
        },
        methods: {
          getRate() {
              axios.get('rate')
              .then(response => {
                  this.rate = response.data.value;
              })
              .catch(e => console.log(e))
          }
        },
        filters: {
            currency: function (value) {
                return parseFloat(value).toFixed(0)+' BsS';
            }
        },
        mounted() {
            this.getRate();
        }
    }
</script>