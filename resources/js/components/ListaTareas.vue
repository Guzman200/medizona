<template>
    <div>
        <crear-tarea @tareaCreada="getTareas()"></crear-tarea>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">

                    <div class="card">
                        <div class="card-body">
                            Tienes {{tareas.length}} tareas
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tarea</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Estatus</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tarea, index) in tareas" :key="index">
                                    <th scope="row">{{tarea.id}}</th>
                                    <td>{{tarea.nombre}}</td>
                                    <td>{{tarea.categoria.descripcion}}</td>
                                    <td>
                                        <span v-if="tarea.realizada == 1" class="badge badge-success">
                                            Realizada
                                        </span>
                                        <span v-else class="badge badge-warning">
                                            Pendiente
                                        </span>
                                    </td>
                                    <td>
                                        <button v-if="tarea.realizada == 0" class="btn btn-success mr-2" @click="updateRealizada(tarea.id)">
                                            Marcar como realizada
                                        </button>
                                        <button class="btn btn-danger mr-2" @click="eliminar(tarea.id)">
                                            Eliminar
                                        </button>
                                        <router-link :to="'/editar-tarea/' + tarea.id " class="btn btn-secondary">
                                            Editar
                                        </router-link>
                                    </td>
                                </tr>
                                <tr v-if="tareas.length == 0" class="text-center">
                                    <th colspan="5">
                                        No hay tareas
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { loaderIn, loaderOut } from './../helper';

import CrearTarea from './CrearTarea';

export default {
    components : {  
        CrearTarea
    },
    data(){
        return {
            tareas : []
        }
    },
    mounted(){
        this.getTareas();
    },
    methods: {
        getTareas(){
            axios.get('/api/tareas')
                .then((response) => {
                    this.tareas = response.data;
                    console.log(response);
                }).catch(({response}) => {
                    console.log(response);
                }).then(() => {

                })
        },
        updateRealizada(tarea_id){

            loaderIn();
            axios.post('/api/tareas/' + tarea_id)
                .then((response) => {
                    this.getTareas();
                    console.log(response);
                }).catch(({response}) => {
                    console.log(response);
                }).then(() => {
                    loaderOut();
                }) 
        },
        eliminar(tarea_id){

            axios.delete('/api/tareas/' + tarea_id)
                .then((response) => {
                    this.getTareas();
                    console.log(response);
                }).catch(({response}) => {
                    console.log(response);
                }).then(() => {
                    loaderOut();
                }) 

        }
    }
}
</script>