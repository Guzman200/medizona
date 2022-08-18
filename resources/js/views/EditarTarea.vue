<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Nombre de la tarea" v-model="nombre">
                </div>
            </div>
            <div class="col-12">
                 <select v-model="categoria_id" class="form-control custom-select">
                    <option value="">Seleccionar categoria de la tara</option>
                    <option v-for="(categoria, index) in categorias" :key="index" :value="categoria.id">
                        {{categoria.descripcion}}
                    </option>
                </select>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-success form-control mt-3" @click="update()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { responseAxios } from './../helper';
export default {
    data(){
        return {
            nombre : '',
            categoria_id : '',
            tarea_id : '',
            categorias : []
        }
    },
    mounted(){
        this.tarea_id = this.$route.params.id;
        this.getCategorias();
        this.getDataTarea();
    },
    methods: {
        getCategorias(){
            axios.get('/api/categorias')
                .then((response) => {
                    console.log(response);
                    this.categorias = response.data;
                }).catch(({response}) => {
                    console.log(response);
                })
        },
        getDataTarea(){
            axios.get('/api/tareas/' + this.tarea_id)
                .then((response) => {
                    console.log(response);
                    this.nombre = response.data.nombre;
                    this.categoria_id = response.data.categoria_id;
                }).catch(({response}) => {
                    console.log(response);
                })
        },
        update(){

            let data = new FormData();

            data.append('nombre', this.nombre)
            data.append('categoria_id', this.categoria_id)

            axios.post('/api/tareas/edit/' + this.tarea_id, data)
                .then((response) => {
                    responseAxios(response)
                }).catch(({response}) => {
                    responseAxios(response)
                    console.log(response);
                }).then(() => {
                    setTimeout(() => {
                        this.$router.push({ path: '/' })
                    }, 200)
                })
        }
    }
}
</script>