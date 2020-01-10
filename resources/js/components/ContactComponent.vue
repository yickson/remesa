<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title mb-5">
                <h2>Contacto</h2>
            </div>
            <form>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombre</label>
                        <input type="text" v-model="name" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Apellido</label>
                        <input type="text" v-model="last_name" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Correo electrónico</label>
                        <input type="text" v-model="email" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Teléfono</label>
                        <input type="text" v-model="phone" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Mensaje</label>
                        <textarea name="" v-model="message" cols="30" rows="10" class="form-control"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary" @click="sendContact">Enviar mensaje</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        template: 'contact-component',
        data() {
            return {
                name: '',
                last_name: '',
                email: '',
                phone: '',
                message: ''
            }
        },
        methods: {
            sendContact(e) {
                e.preventDefault();
                let data = {
                  name: this.name,
                  last_name: this.last_name,
                  email: this.email,
                  phone: this.phone,
                  message: this.message
                };
                axios.post('contact', data)
                .then(response => {
                    if(response.data){
                        this.$swal(
                            'Contacto',
                            'Se ha enviado correctamente',
                            'success'
                        );
                        this.name = '';
                        this.last_name = '';
                        this.email = '';
                        this.phone = '';
                        this.message = '';
                    }
                }).catch(e => console.log(e));
            }
        }
    }
</script>