<template>
  <div class="page">
    <h1 class="text-center">Banco de imagens</h1>
    <div v-if="loaded">
      <b-card v-for="(person, index) in people" :key="person.id">
        <div class="row text-center text-lg-left">
          <div class="col-md-2">
            <h4>{{ person.name }}</h4>
            <p class="sub-title">Criado em: {{ person.created_at | formatDate }}</p>
          </div>
          <div class="col-md-2" v-for="photo in person.photos" :key="photo.id">
            <img :src="pathImage(photo.path_storage)" img-alt="Image" class="img-fluid img-thumbnail" :ref="`photo-${index}`" />
          </div>
        </div>
      </b-card>
    </div>
    <div v-else>
      <p>Carregando dados das imagens...</p>
    </div>
    <div v-if="people.length === 0 && loaded === true">
      <p>Nenhuma imagem foi retornada da consulta!</p>
    </div>
  </div>
</template>

<script>
import { requestsMixin } from "@/mixins/requestsMixin"
import * as faceapi from "face-api.js"

const BASE_URL = "http://localhost"
const API_URL = `${BASE_URL}/api`
const WEIGHTS_URL = `${API_URL}/weights`

export default {
  name: "home",
  mixins: [requestsMixin],
  computed: {
    people() {
      return this.$store.state.peopleImages
    }
  },
  async beforeMount() {
    await faceapi.loadTinyFaceDetectorModel(WEIGHTS_URL)
    await faceapi.loadFaceLandmarkTinyModel(WEIGHTS_URL)
    await faceapi.loadFaceLandmarkModel(WEIGHTS_URL)
    await faceapi.loadFaceRecognitionModel(WEIGHTS_URL)
    await faceapi.loadFaceExpressionModel(WEIGHTS_URL)
    await faceapi.loadAgeGenderModel(WEIGHTS_URL)
    await faceapi.loadFaceDetectionModel(WEIGHTS_URL)
    await this.getAllImages()
    this.loaded = true
  },
  data() {
    return {
      form: {},
      loaded: false
    }
  },
  methods: {
    pathImage(parcialPath) {
      return `${BASE_URL}/${parcialPath}`
    },
    async getAllImages() {
      const { data } = await this.getImages()
      this.$store.commit("setImages", data)
      if (this.$refs.file) {
        this.$refs.file.value = ""
      }
    },

  }
}
</script>

<style>
.sub-title {
  color: blue;
}
.photo {
  max-width: 200px;
  margin-bottom: 10px;
}
</style>
