<template>
    <div>
        <div id="loader"></div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link to="/" class="navbar-brand">App tareas</router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/"
                            >Tareas <span class="sr-only"></span
                        ></router-link>
                    </li>
                </ul>
                <span
                    class="navbar-text"
                    @click="cerrarSesion"
                    style="cursor: pointer"
                >
                    Cerrar sesión
                </span>
            </div>
        </nav>

        <div class="container-fluid mt-4">

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Hola {{nombre()}} es hora de administrar tus tareas!
                        </div>
                    </div>
                </div>
            </div>

            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        cerrarSesion() {
            axios
                .post("/api/logout")
                .then((response) => {
                    window.location.href = "/";
                })
                .catch(({ response }) => {
                    window.location.href = "/";
                });
        },
        nombre(){
            return localStorage.getItem('nombre');
        }
    },
};
</script>

<style>
.btn-primary {
    background-color: #d32f36 !important;
    border-color: #d32f36 !important;
}

.theme-primary .btn-primary:hover,
.theme-primary .btn-primary:active,
.theme-primary .btn-primary:focus,
.theme-primary .btn-primary.active {
    background-color: #c01c26 !important;
    border-color: #c01c26 !important;
    color: #ffffff !important;
}
</style>