export const banksMixin = {
    data() {
        return {
            banks: []
        }
    },
    methods: {
        getBanks() {
            axios.get('./list_banks')
                .then(response => {
                    this.banks = response.data;
                })
                .catch(e => console.error(e))
        }
    },
    mounted() {
        this.getBanks();
    }
}