<template>
  <div class="page">
    <h1 class="text-center">Banco de imagens</h1>
    <button class="btn btn-primary" @click="train()">Treinar</button>
    <picture-input 
      ref="pictureRecognition"
      width="400" 
      height="400" 
      accept="image/jpeg,image/png"
      :removable="true"
      :hideChangeButton="true"
      :custom-strings="{
        drag: 'Toque para escolher uma foto',
        remove: 'Remover a foto'
      }"
      margin="16" 
      >
    </picture-input>
      <div v-if="loaded">
        <b-card class="card-person-images" v-for="person in people" :key="person.id">
          <div class="row text-center text-lg-left">
            <div class="col-md-2">
              <h4>{{ person.name }}</h4>
              <p class="sub-title">Criado em: {{ person.created_at | formatDate }}</p>
            </div>
            <div class="col-md-2" v-for="(photo, index) in person.photos" :key="photo.id">
              <img :id="photoId(person.name, index)" :src="pathImage(photo.path_storage)" img-alt="Image" class="img-fluid img-thumbnail" :ref="`photo-${index}`" />
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
import { requestsMixin } from '@/mixins/requestsMixin'
import * as faceapi from 'face-api.js'
import PictureInput from 'vue-picture-input'

const BASE_URL = 'http://localhost'
const API_URL = `${BASE_URL}/api`
const MODELS_URL = `${API_URL}/models`

export default {
  name: 'home',
  components: {
    PictureInput
  },
  mixins: [requestsMixin],
  computed: {
    people() {
      return this.$store.state.peopleImages
    }
  },
  async beforeMount() {
    await faceapi.loadFaceRecognitionModel(MODELS_URL),
    await faceapi.loadFaceLandmarkModel(MODELS_URL),
    await faceapi.loadTinyFaceDetectorModel(MODELS_URL),
    await faceapi.loadFaceExpressionModel(MODELS_URL)
    await this.getAllImages()
    this.loaded = true
  },
  data() {
    return {
      form: {},
      loaded: false,
    }
  },
  methods: {
    photoId(name, index) {
      return `photo-${name.toLowerCase()}-${index}`
    },
    pathImage(parcialPath) {
      return `${BASE_URL}/${parcialPath}`
    },
    async getAllImages() {
      const { data } = await this.getImages()
      this.$store.commit('setImages', data)
      if (this.$refs.file) {
        this.$refs.file.value = ''
      }
    },
    async train () {
      const self = this
      const faces = []
      await Promise.all(self.people.map(async (person) => {
        const descriptors = []
        await Promise.all(person.photos.map(async (photo, index) => {
          const photoId = self.photoId(person.name, index)
          const img = document.getElementById(photoId)
          const options = {
            detectionsEnabled: true,
            landmarksEnabled: true,
            descriptorsEnabled: true,
            expressionsEnabled: false
          }
          const detections = await self.$store.dispatch('getFaceDetections', { canvas: img, options })
          detections.forEach((d) => {
            descriptors.push({
              path: photo,
              descriptor: d.descriptor
            })
          })
        }))
        faces.push({
          person: person.name,
          descriptors
        })
      }))
      await self.$store.dispatch('saveFaces', faces)
    },
  }
}
</script>

<style>
.sub-title {
  color: blue;
}
.card-person-images {
  margin-top: 25px;
}
.card-body{
  background-color: #eee;
}
.photo {
  max-width: 200px;
  margin-bottom: 10px;
}
</style>
