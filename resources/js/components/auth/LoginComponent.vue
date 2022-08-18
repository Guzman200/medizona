<template>


    <div>
        <!-- LOGIN -->
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                        Medizona - Login
                    </h2>
                    <p v-show="error" class="mt-2 text-center text-sm text-gray-600">
                        <a href="#" class="font-medium text-danger-600 hover:text-indigo-500"> {{mensaje_error}}
                        </a>
                    </p>
                </div>
                <form class="mt-8 space-y-6" action="#" method="POST">
                    <input type="hidden" name="remember" value="true">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Correo electrónico</label>
                            <input id="email-address" name="email" type="email" autocomplete="email"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Correco electrónico"
                                autofocus v-model="email" @keyup.enter="focus('password')">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Contraseña</label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Contraseña" v-model="contrasenia" @keyup.enter="iniciarSesion()">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" v-model="mantener_sesion_abierta" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Mantener sesión abierta </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="button"
                            v-show="cargando == false" @click="iniciarSesion()"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ingresar
                        </button>
                        <button type="button"
                            v-show="cargando"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cargando ..
                        </button>
                    </div>
                </form>
            </div>
        </div>


        

    </div>

</template>

<script>

import { responseAxios } from './../../helper';

export default {
    data(){
        return {
            email : '', 
            contrasenia : '',
            mantener_sesion_abierta : false,
            error : false,
            mensaje_error : '',
            cargando : false
        }
    },
    methods: {
        iniciarSesion(){

            if(this.validarDatosLogin()){

                this.cargando = true;
                axios.get('/sanctum/csrf-cookie').then(response => {
                    
                    axios.post('/api/login', {
                        email : this.email,
                        password : this.contrasenia,
                        remember : this.mantener_sesion_abierta,
                        token_recapchat : this.token_recapchat
                    }).then( (response) => {
                        localStorage.setItem('nombre', response.data.nombre)
                        window.location.href = '/';
                    }).catch( ({response}) => {

                        if(response.data.mensaje == undefined){

                            for (var [key, value] of Object.entries(response.data.errors)) {
                                this.error = true;
                                this.mensaje_error = value[0];
                                break;
                            }

                            
                        }else{
                            this.error = true;
                            this.mensaje_error = response.data.mensaje;
                        }
                        console.log(response);
                    }).then(() => {
                        this.cargando = false;
                    })

                });

            }

        },
        validarDatosLogin(){

            if(this.email == ''){
                this.error = true;
                this.mensaje_error = 'Por favor ingresa tu correo electrónico.';
                return false;
            }

            if(this.contrasenia == ''){
                this.error = true;
                this.mensaje_error = 'Por favor ingresa tu contraseña.';
                return false;
            }

            this.error = false;
            this.mensaje_error = '';
            return true;
        },
        focus(input){
            document.getElementById(input).focus();
        }
    }

}
</script>