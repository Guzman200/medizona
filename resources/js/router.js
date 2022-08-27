import { createRouter, createWebHistory } from 'vue-router'

import TableNotesComponent from './components/notes/TableNotesComponent'
import CreateNoteComponent from './components/notes/CreateNoteComponent'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TableNotesComponent, name : 'home' },
        { path: '/new-note', component: CreateNoteComponent, name: 'new-note' }
    ]
})

