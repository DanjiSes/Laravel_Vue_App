import Vue from 'vue'
import Vuex from 'vuex'
import request from '../services/request'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    activ_category: '',
    products: [],
    categories: []
  },
  mutations: {
    update(state, products) {
      state.products = products
    },
    updateCats(state, categories) {
      state.categories = categories
    }
  },
  actions: {
    update({ commit, state }, category_id = '') {

      request.products(category_id).then((response) => {

        commit('update', response.data)
        state.activ_category = category_id

      }, (error) => {
        console.log(error)
      })

    },
    updateCats({ commit }) {

      request.categories().then((response) => {
        
        commit('updateCats', response.data)

      }).catch((error) => {
        console.log(error)
      })

    }
  }
})