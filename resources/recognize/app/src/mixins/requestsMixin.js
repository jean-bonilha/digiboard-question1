const APIURL = "http://localhost/api"
const axios = require("axios")
export const requestsMixin = {
  methods: {
    getImages() {
      return axios.get(`${APIURL}/images`)
    },
  }
}
