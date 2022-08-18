<template>
    <div class="box" id="errors">
        <div class="box-body">
            <div class="flexbox align-items-baseline mb-20">
                <h6 class="text-uppercase ls-2">Equipo</h6>
                <small>{{total}}</small>
            </div>
            <div class="gap-items-2 gap-y">

                <a class="avatar" href="#" v-for="(item, index) in equipo" :key="index">
                    <img :src="item.perfil_url" alt="foto_user">
                </a>

                <p v-if="total == 0">Aún no cuentas con un equipo</p>

                <a v-show="total > 7" class="avatar avatar-more" href="#">+{{completar}}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        User : Object
    },
    data(){
        return {
            total : 0,
            completar : 0,
            equipo : []
        }
    },
    mounted(){
        this.getEquipo();
    },
    methods: {
        getEquipo(){
            // Por default la api nos regresa solo 7 registros
            axios.get('/api/perfil/equipo')
                .then((response) => {
                    console.log(response);
                    this.equipo = response.data.equipo;
                    this.total  = response.data.total;
                    this.completar = this.total - 7;
                }).catch(({response}) => {
                    console.log(response);
                })
        }
    }
}
</script>