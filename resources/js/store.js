import { createStore } from 'vuex'  

// Create a new store instance.
export const store = createStore({
    state () {
      return {
        user : {
          id         : '',
          nombres    : '',
          apellidos  : '',
          colonia    : '',
          cp         : '',
          created_at : '',
          email      : '',
          estado_id  : '',
          estatus_id : '',
          estado     : {
            pais_id : undefined
          },
          tipo_usuario : {
            id : undefined,
            tipo: ''
          },
          estatus : {
            id : undefined,
            descripcion : ''
          },  
          fecha_nacimiento: '',
          genero_id : '',
          telefono  : '',
          tipo_usuario_id : '',
          portada_url : '',
          perfil_url : ''
        },
      }
    },
    mutations: {
        setDataUserLogueado (state, user) {
          state.user = user;
        },
    },
    actions: {
        async getDataUserLogueado(){

          let self = this;
          const user = new Promise((resolve, reject) => {

            axios.get('/api/user/logueado')
              .then((response) => {
                  resolve(response.data);
              }).catch(({responsse}) => {
                  console.log(responsse);
                  reject(self.state.user);
              })

          });

          return user;         
        },
        setDataUserLogueadoAction(context, user){
            context.commit('setDataUserLogueado', user)
        }
    },
    /*getters: {
      user (state) {
        return state.user;
      }
    }*/
})