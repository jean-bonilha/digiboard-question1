<template>
  <div class="page">
    <h1 class="text-center">Banco de imagens</h1>
    <div v-if="loaded">
      <b-card v-for="(img, index) in images" :key="img.id">
        <div class="row">
          <div class="col-md-2">
            <img :src="img.path_storage" img-alt="Image" class="photo" :ref="`photo-${index}`" />
          </div>
          <div class="col-md-10">
            <h1>{{ img.person.name }}</h1>
            <p class="title">{{ img.person.created_at | formatDate }}</p>
          </div>
        </div>
      </b-card>
    </div>
    <div v-else>
      <p>Loading image data...</p>
    </div>
  </div>
</template>

<script>
  import { requestsMixin } from "@/mixins/requestsMixin"
  import * as faceapi from "face-api.js"
  const WEIGHTS_URL = "http://localhost/api/weights"
  export default {
    name: "home",
    mixins: [requestsMixin],
    computed: {
      images() {
        return this.$store.state.images
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
      async getAllImages() {
        const { data } = await this.getImages()
        this.$store.commit("setImages", data)
        if (this.$refs.file) {
          this.$refs.file.value = ""
        }
      },
      async detectFace(index) {
        const input = this.$refs[`photo-${index}`][0]      
        const options = new faceapi.TinyFaceDetectorOptions({
          inputSize: 128,
          scoreThreshold: 0.3
        })
        const detections = await faceapi
          .detectAllFaces(input, options)
          .withFaceLandmarks()
          .withFaceExpressions()
          .withAgeAndGender()
          .withFaceDescriptors()
        this.images[index].detections = detections
        this.getAllImages()
      }
    }
  }
</script>

<style>
  .photo {
    max-width: 200px;
    margin-bottom: 10px;
  }
</style>
