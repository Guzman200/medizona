<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                        Medizona - Recuperación de contrañsea
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
                                autofocus v-model="email" @keyup.enter="enviarCorreo()">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <router-link to="inicio-sesion" class="font-medium text-indigo-600 hover:text-indigo-500"> 
                                Regresar al inicio de sesión
                            </router-link>
                        </div>
                    </div>

                    <div>
                        <button type="button"
                            v-show="cargando == false" @click="enviarCorreo()"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Enviar correo
                        </button>
                        <button type="button"
                            v-show="cargando"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Enviando correo ..
                        </button>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
export default {
    data(){
        return {
            email : "",
            cargando : false,
            error : false,
            mensaje_error : '',
        }
    },
    methods: {
        enviarCorreo(){

            // Si el correo esta vacio
            if(this.email == ""){
                this.error = true;
                this.mensaje_error = "Por favor ingresa tu correo electrónico"
                return false;
            }

            this.cargando = true;
                
            axios.post('/api/recover-password', {
                email : this.email
            }).then( (response) => {
                this.error = true;
                this.mensaje_error = "Te hemos enviando un correo electrónico a la dirección " + this.email + ", por favor verifica tu bandeja de mensajes.";
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
        }
    }
}
</script>