<template>
    <div class="container mx-auto flex flex-wrap pt-4 pb-12">
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                <p class="text-center text-gray-800 text-lg px-6 mb-5 mt-5">
                    Tasa del día: {{ rate }}
                </p>
            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                <form class="w-full max-w-sm">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Monto a cambiar
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input v-model="money" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">
                        </div>
                    </div>
                </form>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <h3 class="text-center text-red-300 text-3xl">
                            Dinero a recibir: {{ money * rate | currency }}
                        </h3>
                    </div>
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