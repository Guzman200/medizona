import { createRouter, createWebHistory } from 'vue-router'

import TableNotesComponent from './components/notes/TableNotesComponent'
//import MenuComponent from './components/notes/MenuComponent'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TableNotesComponent }
    ]
})

