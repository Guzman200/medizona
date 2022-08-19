import { createRouter, createWebHistory } from 'vue-router'

import LoginComponent from './LoginComponent';
import RegistroComponent from './RegistroComponent';
import RecoverPasswordComponent from './RecoverPasswordComponent';


export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/inicio-sesion', component: LoginComponent },
        { path: '/registro', component: RegistroComponent },
        { path: '/recuperar-contrasenia', component: RecoverPasswordComponent },
    ]
}) 

