import Vue from 'vue'
import Vuex from 'vuex'
import * as faceapi from 'face-api.js'
const axios = require('axios')

Vue.use(Vuex)

export default

new Vuex.Store({
    state: {
        peopleImages: [],
        faces: [],
        faceMatcher: null,

        useTiny: false,

        detections: {
          scoreThreshold: 0.5,
          inputSize: 320,
          boxColor: 'blue',
          textColor: 'red',
          lineWidth: 1,
          fontSize: 20,
          fontStyle: 'Georgia'
        },
        expressions: {
          minConfidence: 0.2
        },
        landmarks: {
          drawLines: true,
          lineWidth: 1
        },
        descriptors: {
          withDistance: false
        }
    },
    mutations: {
        setImages(state, payload) {
            state.peopleImages = payload
        },
        setFaces(state, payload) {
            state.faces = payload
        },
        setFaceMatcher(state, payload) {
            state.faceMatcher = payload
        },
    },
    actions: {
        async getFaces({ commit }) {
            const data = await axios.get('faces')
            commit('setFace', data)
        },
        async saveFaces({ commit }, faces) {
            const { data } = await axios.post('faces', { faces })
            commit('setFace', data)
        },
        async getFaceDetections({ state }, { canvas, options }) {
            let detections = faceapi
              .detectAllFaces(canvas, new faceapi.TinyFaceDetectorOptions({
                scoreThreshold: state.detections.scoreThreshold,
                inputSize: state.detections.inputSize
              }))

            if (options && (options.landmarksEnabled || options.descriptorsEnabled)) {
              detections = detections.withFaceLandmarks(state.useTiny)
            }
            if (options && options.expressionsEnabled) {
              detections = detections.withFaceExpressions()
            }
            if (options && options.descriptorsEnabled) {
              detections = detections.withFaceDescriptors()
            }
            detections = await detections
            return detections
        },
        async recognize ({ state }, { descriptor, options }) {
          if (options.descriptorsEnabled) {
            const bestMatch = await state.faceMatcher.findBestMatch(descriptor)
            return bestMatch
          }
          return null
        },
        draw ({ state }, { canvasDiv, canvasCtx, detection, options }) {
          let emotions = ''
          // filter only emontions above confidence treshold and exclude 'neutral'
          if (options.expressionsEnabled && detection.expressions) {
            for (const expr in detection.expressions) {
              if (detection.expressions[expr] > state.expressions.minConfidence && expr !== 'neutral') {
                emotions += ` ${expr} &`
              }
            }
            if (emotions.length) {
              emotions = emotions.substring(0, emotions.length - 2)
            }
          }
          let name = ''
          if (options.descriptorsEnabled && detection.recognition) {
            name = detection.recognition.toString(state.descriptors.withDistance)
          }

          const text = `${name}${emotions ? (name ? ' is ' : '') : ''}${emotions}`
          const box = detection.box || detection.detection.box
          if (options.detectionsEnabled && box) {
            // draw box
            canvasCtx.strokeStyle = state.detections.boxColor
            canvasCtx.lineWidth = state.detections.lineWidth
            canvasCtx.strokeRect(box.x, box.y, box.width, box.height)
          }
          if (text && detection && box) {
            // draw text
            const padText = 2 + state.detections.lineWidth
            canvasCtx.fillStyle = state.detections.textColor
            canvasCtx.font = state.detections.fontSize + 'px ' + state.detections.fontStyle
            canvasCtx.fillText(text, box.x + padText, box.y + box.height + padText + (state.detections.fontSize * 0.6))
          }

          if (options.landmarksEnabled && detection.landmarks) {
            faceapi.draw.drawFaceLandmarks(canvasDiv, detection.landmarks, { lineWidth: state.landmarks.lineWidth, drawLines: state.landmarks.drawLines })
          }
        },
    },
})
