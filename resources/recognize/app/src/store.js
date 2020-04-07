import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex)

export default

new Vuex.Store({
    state: {
        peopleImages: []
    },
    mutations: {
        setImages(state, payload) {
            state.peopleImages = payload
        }
    },
    actions: {}
})
