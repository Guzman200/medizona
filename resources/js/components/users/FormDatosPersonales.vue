<template>
     <div class="box">
        <form class="form" @submit.prevent="update">

            <div class="box-body">

                <slot name="title-form">
                    <h4 class="box-title text-primary mb-0"><i class="ti-user me-15"></i> Datos personales</h4>
                    <hr class="my-15">
                </slot>

                <p v-show="error" class="text-danger text-center">
                    <i class="fa fa-exclamation-circle"></i>
                        {{mensaje_error}}
                </p>

                <a id="aerrors" href="#errors" class="d-none"></a>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Nombre(s)</label>
                            <input @keyup.enter="focus('apellidos')" v-model="user.nombres" type="text" class="form-control" placeholder="Ingresar nombres(s)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input @keyup.enter="focus('username')" id="apellidos" v-model="user.apellidos" type="text" class="form-control" placeholder="Ingresar apellidos">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Nombre de usuario</label>
                            <input @keyup.enter="focus('email')" id="username" v-model="user.username" type="text" class="form-control" placeholder="Ingresar nombre de usuario">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Correo electrónico</label>
                            <input @keyup.enter="focus('password')" id="email" v-model="user.email" type="text" class="form-control" placeholder="Ingresar correo electrónico">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Nueva contraseña</label>
                            <input v-model="password" @keyup.enter="focus('paises')" id="password" type="text" class="form-control" placeholder="Ingresar nueva contraseña">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">País</label>
                            <select id="paises" @keyup.enter="focus('estado')" v-model="user.estado.pais_id" class="form-select" @change="changePais">
                                <option v-for="(pais, index) in paises" :key="index" :value="pais.id">
                                    {{pais.nombre}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Estado</label>
                            <select @keyup.enter="focus('colonia')" id="estado" v-model="user.estado_id" class="form-select">
                                <option value="">Seleccionar estado</option>
                                <option v-for="(estado, index) in estadosDelPaisSeleccionado" :key="index" :value="estado.id">
                                    {{estado.nombre}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Colonía</label>
                            <input @keyup.enter="focus('cp')" id="colonia" v-model="user.colonia" type="text" class="form-control" placeholder="Ingresar colonía">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Código postal</label>
                            <input @keyup.enter="focus('genero')" id="cp" v-model="user.cp" type="text" class="form-control" placeholder="Ingresar código postal">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Genero</label>
                            <select @keyup.enter="focus('fecha_nacimiento')" id="genero" v-model="user.genero_id" class="form-select">
                                <option v-for="(genero, index) in generos" :key="index" :value="genero.id">
                                    {{genero.descripcion}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Fecha de nacimiento</label>
                            <input @keyup.enter="focus('telefono')" id="fecha_nacimiento" v-model="user.fecha_nacimiento" type="date" class="form-control" placeholder="Ingresar fecha de nacimiento">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input @keyup.enter="update" id="telefono" v-model="user.telefono" type="number" class="form-control" placeholder="Ingresar teléfono">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <slot name="footer" v-bind:update="update" v-bind:loading="loading">

            </slot>
            
        </form>
    </div>
</template>

<script>

import { sweetInfo } from '../../helper';

export default {
    props : {
        user : Object
    },
    data(){
        return {
            paises   : [],
            estados  : [],
            generos  : [],
            password : '',
            error : false,
            mensaje_error : '',
            loading : false
        }
    },
    async created(){
        await this.getGeneros(); 
        await this.getPaises();
        this.getEstados();
    },
    methods: {
        async getPaises(){
           const paises = new Promise((resolve, reject) => {
                axios.get('/api/paises')
                .then((response) => {
                    this.paises = response.data.paises;
                    resolve({});
                }).catch(({response}) => {
                    console.log(response);
                    reject({})
                })
           }) 
        },
        getEstados(){
 
            axios.get(`/api/estados/`)
                .then((response) => {
                    this.estados = response.data.estados;
                }).catch(({response}) => {
                    console.log(response);
                });
        },
        async getGeneros(){
            const generos = new Promise((resolve, reject) => {
                axios.get('/api/generos')
                .then((response) => {
                    this.generos = response.data.generos;
                    resolve({});
                }).catch(({response}) => {
                    console.log(response);
                    reject({});
                })
            })
        },
        update(){

            if(!this.validarDatos()){
                document.getElementById('aerrors').click();
                return false;
            }

            let self = this;

            this.loading = true;
            axios.post(`/api/user/update/${this.user.id}`, {
                nombres   : this.user.nombres,
                apellidos : this.user.apellidos,
                username  : this.user.username,
                email     : this.user.email,
                password  : this.password,
                estado_id : this.user.estado_id,
                colonia   : this.user.colonia,
                cp        : this.user.cp,
                genero_id : this.user.genero_id,
                fecha_nacimiento : this.user.fecha_nacimiento,
                telefono  : this.user.telefono
            }).then((response) => {
                this.error = false;
                this.mensaje_error = '';

                sweetInfo('<h4 class="box-title mb-0 fw-bold">Modificación exitosa</h4>', '', 'success');

                self.$store.dispatch('setDataUserLogueadoAction', response.data.user);
                console.log(response);
            }).catch(({response}) => {
                
                for (var [key, value] of Object.entries(response.data.errors)) {
                    this.error = true;
                    this.mensaje_error = value[0];
                    break; 
                }
                document.getElementById('aerrors').click()
                console.log(response);

            }).then(() => self.loading = false);
        },
        focus(input_id){
            document.getElementById(input_id).focus();
        },
        changePais(){
            this.user.estado_id = "";
        },
        validarDatos(){

            if(this.user.nombres == ''){
                this.error = true;
                this.mensaje_error = 'El campo nombre(s) es obligatorio.';
                return false;
            }

            if(this.user.apellidos == ''){
                this.error = true;
                this.mensaje_error = 'El campo apellidos es obligatorio.';
                return false;
            }

            if(this.user.username == ''){
                this.error = true;
                this.mensaje_error = 'El campo nombre de usuario es obligatorio.';
                return false;
            }

            if(this.user.email == ''){
                this.error = true;
                this.mensaje_error = 'El campo correo electrónico es obligatorio.';
                return false;
            }

            if(!this.validarEmail(this.user.email)){
                this.error = true;
                this.mensaje_error = 'Por favor ingresa un correo electrónico valido.';
                return false;
            }


            if(this.user.estado_id == ''){
                this.error = true;
                this.mensaje_error = 'El campo estado es obligatorio.';
                return false;
            }

            this.error = false;
            this.mensaje_error = '';
            return true;

        },
        validarEmail: function (email) {

            let validacion = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            return validacion.test(email);
        },
    },
    computed: {
        estadosDelPaisSeleccionado(){
            return this.estados.filter((estado) => estado.pais_id == this.user.estado.pais_id);
        }
    }
}
</script>