import Vue from "vue"
import Router from "vue-router"
import Home from "./components/Home.vue"

Vue.use(Router)

export default new Router({
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/images",
            name: "images",
            component: Home
        }
    ]
})
