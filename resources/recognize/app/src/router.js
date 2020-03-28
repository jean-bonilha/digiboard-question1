import Vue from "vue"
import Router from "vue-router"
import Images from "./components/Images.vue"
import Train from "./components/Train.vue"

Vue.use(Router)

export default new Router({
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/images",
            name: "images",
            component: Images
        },
        {
            path: "/train",
            name: "train",
            component: Train
        },
    ]
})
