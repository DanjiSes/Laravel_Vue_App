let axios = require('axios')

let request = {

  // CATEGORIES
  categories (list = 0) {
    return axios.get(this.CATEGORY_URL, {
      params: {
        list: list
      }
    })
  },

  products (category_id = '') {
    return axios.get(this.PRODUCT_URL, {
      params: {
        'category_id': category_id
      }
    })
  },

  addCategory (category) {
    return axios.post(this.CATEGORY_URL + '/add', {
      name: category.name,
      parent_id: category.parent_id
    })
  },

  addProduct (data) {
    return axios.post(this.PRODUCT_URL + '/add', data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  }

}

request.BASE_URL = 'http://vk-test.sl'
request.API_URL = request.BASE_URL + '/api'
request.CATEGORY_URL = request.API_URL + '/categories'
request.PRODUCT_URL = request.API_URL + '/products'

export default request