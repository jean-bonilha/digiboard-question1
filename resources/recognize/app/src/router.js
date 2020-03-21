import Vue from "vue"
import Router from "vue-router"
import Home from "./components/Home.vue"

Vue.use(Router)

export default new Router({
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/home",
            name: "home",
            component: Home
        }
    ]
})
