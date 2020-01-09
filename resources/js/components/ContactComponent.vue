<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title mb-5">
                <h2>Contacto</h2>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nombre</label>
                        <input type="text" v-model="nombre" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Apellido</label>
                        <input type="text" v-model="apellido" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Correo electrónico</label>
                        <input type="text" v-model="correo" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Teléfono</label>
                        <input type="text" v-model="telefono" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Mensaje</label>
                        <textarea name="" v-model="mensaje" cols="30" rows="10" class="form-control"/>
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
                nombre: '',
                apellido: '',
                correo: '',
                telefono: '',
                mensaje: ''
            }
        },
        methods: {
            sendContact() {
                let data = {
                  nombre: this.nombre,
                  apellido: this.apellido,
                  correo: this.correo,
                  telefono: this.telefono,
                  mensaje: this.mensaje
                };
                console.log('Enviar contacto ', data);
            }
        }
    }
</script>