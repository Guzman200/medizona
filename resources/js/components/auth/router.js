import { createRouter, createWebHistory } from 'vue-router'

import LoginComponent from './LoginComponent';
import RegistroComponent from './RegistroComponent';
import RecoverPasswordComponent from './RecoverPasswordComponent';
import ChangePasswordComponent from './ChangePasswordComponent';


export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/inicio-sesion', component: LoginComponent, name : "login" },
        { path: '/registro', component: RegistroComponent },
        { path: '/recuperar-contrasenia', component: RecoverPasswordComponent },
        { path: '/recover-password/:token/:email', component : ChangePasswordComponent}
    ]
}) 

