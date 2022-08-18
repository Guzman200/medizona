<template>
    <div class="box box-widget widget-user">

        <!-- BOTON DE AYUDA PARA ABRIR EL MODAL DE LA EDICION DE FOTO -->
        <button id="btnAbrirModalEditarFoto" type="button" class="btn d-none"
                    data-bs-toggle="modal" data-bs-target="#myModal">
                    <span class="fa fa-edit" style="color: white"></span>
        </button>

        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-img bbsr-0 bber-0" :style="{ background: portadaUrl}" data-overlay="5">

            <!-- Solo tiene permiso el super admin y el admin de modificar la foto de portada -->
            <div v-if="user.tipo_usuario_id == 1 || user.tipo_usuario_id == 2" class="float-left">
                <button type="button" class="btn btn-editar-foto" style="background-color: #D32F36; float: right;"
                    @click="abrirModal('portada')">
                    <span class="fa fa-edit" style="color: white"></span>
                </button>
            </div>
            <h3 class="widget-user-username text-white">
                {{user.nombre_negocio}}
            </h3>
            <h6 class="widget-user-desc text-white">
                {{user.tipo_usuario.tipo}}
            </h6>
            <p class="text-white fecha-creacion">Fecha de registro {{fechaCreacion}}</p>
        </div>
        <div class="widget-user-image">
            <div class="float-left">
                <button type="button" class="btn btn-editar-foto-perfil"
                    @click="abrirModal('perfil')">
                    <span class="fa fa-edit" style="color: white"></span>
                </button>
            </div>
            <img class="rounded-circle" :src="perfilUrl" alt="User Avatar">
        </div>
        
        <div class="box-footer">

             <div class="row mb-3">
                <div class="col-12 text-center">
                    <h5 class="box-title text-primary mt-4">{{user.nombres}} {{user.apellidos}}</h5>
                    <h6 :class="textColor" class="box-title mt-1">{{user.estatus.descripcion}}</h6>
                </div>
            </div>

            <slot name="estadisticas"></slot>
        </div>

        <!-- MODAL PARA LA EDICION DE FOTOS DE PERFIL Y ADMINISTRADOR -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Editando foto de {{this.tipo_foto}}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p v-show="error" class="text-danger text-center">
                            <i class="fa fa-exclamation-circle"></i>
                                {{mensaje_error}}
                        </p>

                        <p class="text-center">Previsualización de imagen seleccionada</p>
                        <div v-if="tipo_foto == 'portada'" class="widget-user-header bg-img bbsr-0 bber-0 mb-3" 
                            :style="{ background : url_preview}" data-overlay="5">
                        </div>

                        <div v-if="tipo_foto == 'perfil'" style="text-align: center; margin-bottom: 15px;">
                            <img style="width: 90px;" class="rounded-circle" :src="url_preview" alt="Imagen no seleccionada">
                        </div>



                        <div class="mb-3">
                            <label for="file" class="form-label">Selecciona tu nueva foto de {{this.tipo_foto}}</label>
                            <input class="form-control" type="file" id="file" @change="changeFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-show="loader" type="button" class="btn btn-primary float-end">Actualizando foto ...</button>
                        <button v-show="!loader" @click="modificarFoto" type="button" class="btn btn-primary float-end">Actualizar foto</button>
                        <button v-show="!loader" id="modalBtnFotoCerrar" type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </div>
</template>

<script>

import {moment, sweetInfo}  from './../../helper';

export default {
    props : {
        user : Object
    },
    data(){
        return {
            tipo_foto : '', // perfil || portada (dependiendo de la foto que se este editando)
            error : false,
            mensaje_error : '',
            url_preview : '',
            file : '',
            loader : false
        }
    },
    methods: {
        modificarFoto(){

            if(this.validarFoto()){

                let data = new FormData();
                data.append('imagen', this.file);

                console.log('updated');

                this.loader = true;
                axios.post(`/api/perfil/modificarFoto/${this.tipo_foto}`, data)
                    .then( async (response) => {

                        document.getElementById('modalBtnFotoCerrar').click(); // cerramos el modal

                        if(this.tipo_foto == 'portada'){
                            this.user.portada_url = response.data.new_imagen_url;
                        }else if(this.tipo_foto == 'perfil'){

                            let dataUser = await this.$store.dispatch('getDataUserLogueado');

                            this.$store.dispatch('setDataUserLogueadoAction', dataUser);

                            this.user.perfil_url = response.data.new_imagen_url;
                        }
                        
                        this.url_preview = '';
                        this.file = '';
                        document.getElementById('file').value = ''; // reseteamos el input file

                        sweetInfo(`<h4 class="box-title mb-0 fw-bold">Modificación de foto de ${this.tipo_foto} exitosa</h4>`, '', 'success');

                    }).catch(({response}) => {

                        for (var [key, value] of Object.entries(response.data.errors)) {
                            this.error = true;
                            this.mensaje_error = value[0];
                            break; 
                        }

                        console.log(response);
                    }).then(() => {
                        this.loader = false;
                    })
            }
        },
        changeFile(event){
            this.file = event.target.files[0];

            if(this.file){

                this.error = false;
                this.mensaje_error = '';
                if(this.tipo_foto == 'portada'){
                    this.url_preview = `url('${URL.createObjectURL(this.file)}') center center`;
                }else if(this.tipo_foto == 'perfil'){
                    this.url_preview = URL.createObjectURL(this.file);
                }

            }else {
                this.url_preview = '';                
            }
        },
        validarFoto(){


            if(!this.file){
                this.error = true;
                this.mensaje_error = 'Por favor selecciona una foto de portada';
                return false;
            }

            if( !(this.file.type == 'image/jpg' || this.file.type == 'image/png' || this.file.type == 'image/jpeg' || this.file.type == 'image/gif') ){
                this.error = true;
                this.mensaje_error = 'Fomarto no aceptado, solo se aceptan los formatos jpg, png, jpeg y gif.';
                return false;
            }

            this.error = false;
            this.mensaje_error = '';
            return true;
        },
        abrirModal(tipo_foto){

            this.tipo_foto = tipo_foto;

            this.file = '';
            this.error = false;
            this.mensaje_error = '';
            this.url_preview = '';
            document.getElementById('file').value = ''; // reseteamos el input file

            if(this.tipo_foto == 'perfil'){
                this.url_preview = this.perfilUrl;
            }

            document.getElementById('btnAbrirModalEditarFoto').click();
        }
    },
    computed: {
        textColor(){
            if(this.user.estatus.id == 1){ // activo
                return 'text-success';
            }else if(this.user.estatus.id == 2){ // Desactivado
                return 'text-red';
            }else if(this.user.estatus.id == 3){ // Suspendido
                return 'text-danger';
            }
        },
        fechaCreacion(){
            return moment(this.user.created_at).format('DD/MM/YYYY');
        },
        portadaUrl(){
            return  `url('${this.user.portada_url}') center center`;
        },
        perfilUrl(){

            if(this.user.perfil_url == "" || this.user.perfil_url == undefined){

                if(this.user.genero_id == 1){ // hombre
                    return "template/images/avatar/6.jpg";
                }else { // mujer u otro
                    return "template/images/avatar/9.jpg";
                }
            }else{
                return this.user.perfil_url;
            }

        }
    }
}
</script>


<style scoped>

    .text-red {
        color : #D32F36;
    }

    .btn-editar-foto {
        width: 35px;
        height: 35px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    .btn-editar-foto-perfil {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        background-color: rgb(211, 47, 54);
        float: left;
        position: absolute;
        top: -7px;
        left: 63px;
    }

    .fecha-creacion {
        text-align: end;
        position: relative;
        top: 36px;
    }

    @media (max-width: 554px) { 

        .fecha-creacion {
            display: none;
        }

    }

</style>