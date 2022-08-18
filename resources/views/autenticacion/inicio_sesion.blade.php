<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medizona - Login</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <div id="app-login">
        <app-login></app-login>
    </div>

    <!-- Vue App Login -->
    <script src="{{ mix('js/app-login.js') }}"></script>

</body>

</html>


{{--
<div class="col-12">
            <div class="row justify-content-center g-0">
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="bg-white rounded10 shadow-lg">
                        <div class="content-top-agile p-20 pb-0">
                            <h2 class="text-primary">Bienvenido de nuevo!</h2>
                            <p class="mb-0">Empecemos</p>							
                        </div>
                        <div class="p-40">
                            <p v-show="error" class="text-danger text-center">
                                <i class="fa fa-exclamation-circle"></i>
                                {{mensaje_error}}
                            </p>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                        <input autofocus v-model="nombre_usuario" type="text" class="form-control ps-15 bg-transparent" 
                                            placeholder="Nombre de usuario" @keyup.enter="focus('password')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
                                        <input id="password" v-model="contrasenia" type="password" class="form-control ps-15 bg-transparent" 
                                            placeholder="Contraseña" @keyup.enter="iniciarSesion()">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="checkbox">
                                        <input v-model="mantener_sesion_abierta" type="checkbox" id="basic_checkbox_1" >
                                        <label for="basic_checkbox_1">Mantener sesión abierta</label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button v-show="cargando == false" @click="iniciarSesion()" type="button" class="btn btn-danger mt-10">Inicia sesión</button>
                                        <button disabled v-show="cargando" type="button" class="btn btn-danger mt-10">Cargando ...</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>	
                            <div class="text-center">
                                <p class="mt-15 mb-0">
                                    <router-link to="/registro" class="hover-warning"><i class="ion ion-locked"></i> ¿No tienes cuenta? Registrarse</router-link><br>
                                </p>
                            </div>	
                        </div>						
                    </div>
                </div>
            </div>
        </div>
--}}