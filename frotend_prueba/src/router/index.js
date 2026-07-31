import { createRouter, createWebHistory } from 'vue-router'

import Users from '../views/Users.vue'
import mainLayout from "../layouts/mainLayout.vue"
import HelloWorld from '../components/HelloWorld.vue'



const routes = [
    {
        path: "/gestion",
        component: mainLayout,
        children: [
            {
                path: "horarios",
                name:"AdminUsers",
                component: Users
            }
        ]
    },
    {
        path: "/",
        name: "home",
        component: HelloWorld
    }
]

const router = createRouter({
    history: createWebHistory(),

    routes
})

export default router