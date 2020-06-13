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
                    console.log(response.data);
                    this.banks = response.data;
                })
                .catch(e => console.log(e))
        }
    },
    mounted() {
        this.getBanks();
    }
}