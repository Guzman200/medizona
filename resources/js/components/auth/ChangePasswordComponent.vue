<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                        Medizona - Cambiar contrañsea
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
                            <input disabled id="email-address" name="email" type="email" autocomplete="email"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Correco electrónico"
                                autofocus v-model="email" @keyup.enter="enviarCorreo()">
                        </div>
                    </div>

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Contraseña</label>
                            <input id="email-address" name="email" type="password" autocomplete="email"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Nueva contraseña"
                                autofocus v-model="password">
                        </div>
                    </div>

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Contraseña</label>
                            <input id="email-address" name="email" type="password" autocomplete="email"
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Nueva contraseña confirmación"
                                autofocus v-model="password_confirmed">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            <router-link :to="{name : 'login'}" class="font-medium text-indigo-600 hover:text-indigo-500"> 
                                Regresar al inicio de sesión
                            </router-link>
                        </div>
                    </div>

                    <div>
                        <button type="button"
                            v-show="cargando == false" @click="restaurarPassword()"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Restaurar contraseña
                        </button>
                        <button type="button"
                            v-show="cargando"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cargando ...
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
            token : "",
            password : "",
            password_confirmed : "",
            cargando : false,
            error : false,
            mensaje_error : '',
        }
    },
    mounted(){
        this.email = this.$route.params.email;
        this.token = this.$route.params.token;
    },
    methods: {
        restaurarPassword(){

            if(this.password == ""){
                this.error = true;
                this.mensaje_error = "Por favor ingresa una contraseña"
                return false;
            }

            if(this.password_confirmed == ""){
                this.error = true;
                this.mensaje_error = "Por favor confirma tu contraseña"
                return false;
            }

            this.cargando = true;
                
            axios.put('/api/change-password', {
                email : this.email,
                token : this.token,
                password : this.password,
                password_confirmation : this.password_confirmed
            }).then( (response) => {
                this.error = true;
                this.mensaje_error = "Tu contraseña ha sido modificada con exito! Ya puedes iniciar sesión con tu nueva contraseña.";
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