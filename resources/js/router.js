import { createRouter, createWebHistory } from 'vue-router'

import Tareas from './views/Tareas'
import EditarTarea from './views/EditarTarea'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Tareas },
        { path: '/editar-tarea/:id', component : EditarTarea}
    ]
})

