export const rateMixin = {
    data() {
        return {
            rate: ''
        }
    },
    methods: {
        getRate() {
            axios.get('/rate')
                .then(response => {
                    this.rate = response.data.value;
                })
                .catch(e => console.log(e))
        }
    },
    mounted() {
        this.getRate();
    }
}