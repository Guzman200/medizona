<template>
    <div>
        <!-- LOGIN -->
        <div class="col-12">
            <div class="row justify-content-center g-0">
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="bg-white rounded10 shadow-lg">
                        <div class="content-top-agile p-20 pb-0">
                            <h2 class="text-primary">Registro</h2>
                        </div>
                        <div class="p-40">
                            <p v-show="error" class="text-danger text-center">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ mensaje_error }}
                            </p>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text bg-transparent"
                                            ><i class="ti-user"></i
                                        ></span>
                                        <input
                                            autofocus
                                            v-model="nombre"
                                            type="text"
                                            class="form-control ps-15 bg-transparent"
                                            placeholder="Nombre"
                                            @keyup.enter="focus('username')"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text bg-transparent"
                                            ><i class="ti-user"></i
                                        ></span>
                                        <input
                                            id="username"
                                            autofocus
                                            v-model="nombre_usuario"
                                            type="text"
                                            class="form-control ps-15 bg-transparent"
                                            placeholder="Nombre de usuario"
                                            @keyup.enter="focus('password')"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text bg-transparent"
                                            ><i class="ti-lock"></i
                                        ></span>
                                        <input
                                            id="password"
                                            v-model="contrasenia"
                                            type="password"
                                            class="form-control ps-15 bg-transparent"
                                            placeholder="Contraseña"
                                            @keyup.enter="iniciarSesion()"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button
                                            v-show="cargando == false"
                                            @click="registrarse()"
                                            type="button"
                                            class="btn btn-danger mt-10"
                                        >
                                            Registrarse
                                        </button>
                                        <button
                                            disabled
                                            v-show="cargando"
                                            type="button"
                                            class="btn btn-danger mt-10"
                                        >
                                            Cargando ...
                                        </button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="mt-15 mb-0">
                                    <router-link
                                        to="/inicio-sesion"
                                        class="hover-warning"
                                        ><i class="ion ion-locked"></i> Iniciar
                                        sesión</router-link
                                    ><br />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

import { responseAxios } from "./../../helper";
export default {
    data() {
        return {
            nombre: "",
            nombre_usuario: "",
            contrasenia: "",
            error: false,
            mensaje_error: "",
            cargando: false,
        };
    },
    methods: {
        registrarse() {

            let data = new FormData();
            data.append("nombre", this.nombre);
            data.append("username", this.nombre_usuario),
            data.append("password", this.contrasenia);

            axios.post("/api/register", data)
                .then((response) => {
                    responseAxios(response);
                    this.nombre = '';
                    this.nombre_usuario = '';
                    this.contrasenia = '';
                    this.error = false;
                    this.mensaje_error = '';
                })
                .catch(({ response }) => {
                    for (var [key, value] of Object.entries(
                        response.data.errors
                    )) {
                        this.error = true;
                        this.mensaje_error = value[0];
                        break;
                    }
                });
        },
    },
};
</script>