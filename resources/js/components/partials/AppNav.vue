<template>
  <nav class="navbar">

    <div class="navbar-item">
      <button class="button is-primary"
              @click="category_editor = true">
        <b>+ CATEGORY</b>
      </button>
    </div>

    <div class="navbar-item">
      <button class="button is-primary"
              @click="product_editor = true">
        <b>+ PRODUCT</b>
      </button>
    </div>

    <div class="modal is-active" v-if="category_editor">
      <div class="modal-background" @click="category_editor = false"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Category editor</p>
          <button class="delete" aria-label="close" @click="category_editor = false"></button>
        </header>
        <section class="modal-card-body">

          <div class="field">
            <div class="control">
              <input type="text" class="input" placeholder="Name"
                     v-model="category.name">
            </div>
          </div>

          <div class="field">
            <div class="control">
              <div class="select">
                <select v-model="category.parent_id">
                  <option value="">Parent category</option>
                  <option v-for="category in categories" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <p class="is-size-7 has-text-grey">Not a required field</p>
            </div>
          </div>

        </section>
        <footer class="modal-card-foot">
          <button class="button is-success" @click="saveCategory">
            <b>Save</b>
          </button>
          <button class="button">Cancel</button>
        </footer>
      </div>
    </div>

    <div class="modal is-active" v-if="product_editor">
      <div class="modal-background" @click="product_editor = false"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Product editor</p>
          <button class="delete" aria-label="close" @click="product_editor = false"></button>
        </header>
        <section class="modal-card-body">

          <div class="field">
            <div class="control">
              <input type="text" class="input" placeholder="Name"
                     v-model="product.name">
            </div>
          </div>

          <div class="field">
            <div class="control">
              <textarea class="textarea" placeholder="Description"
                        v-model="product.descript"></textarea>
            </div>
          </div>

          <div class="field">
            <div class="control">
              <div class="select">
                <select v-model="product.category_id">
                  <option value="">Category</option>
                  <option v-for="category in categories" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="file">
              <label class="file-label">
                <input class="file-input" type="file" name="resume"
                       ref="image"
                       @change="choseFile">
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fa fa-upload"></i>
                  </span>
                  <span class="file-label">
                    Choose a file…
                  </span>
                </span>
              </label>
            </div>
          </div>

          <div class="field">
            <img :src="image_preview">
          </div>

        </section>
        <footer class="modal-card-foot">
          <button class="button is-success" @click="saveProduct">
            <b>Save</b>
          </button>
          <button class="button">Cancel</button>
        </footer>
      </div>
    </div>

  </nav>
</template>

<script>
  import request from '../../services/request'

  export default {
    data() {
      return {
        category_editor: false,
        product_editor: false,
        category: {
          name: '',
          parent_id: ''
        },
        categories: [],
        product: {
          name: '',
          descript: '',
          category_id: '',
          image: ''
        },
        image_preview: ''
      }
    },
    computed: {
    },
    methods: {
      saveCategory() {

        request.addCategory(this.category).then((response) => {

          console.log(response.data)

          this.$store.dispatch('updateCats')

          this.category.name = ''
          this.category.parent_id = ''

          this.category_editor = false

        }, (error) => {
          console.log(error)
        })

      },
      choseFile() {
        this.product.image = this.$refs.image.files[0]

        const reader = new FileReader()
        reader.readAsDataURL(this.product.image)
        reader.onload = () => { this.image_preview = reader.result }
      },
      saveProduct() {
        let productData = new FormData()

        productData.append('image', this.product.image)
        productData.append('name', this.product.name)
        productData.append('descript', this.product.descript)
        productData.append('category_id', this.product.category_id)

        request.addProduct(productData).then((response) => {

          console.log(response.data)

          this.$store.dispatch('update')

          this.product_editor = false

          this.product.name = ''
          this.product.descript = ''
          this.product.category_id = ''
          this.product.image = ''
          this.image_preview = ''

        }, (error) => {
          console.log(error)
        })
      }
    },
    mounted() {

      request.categories(true).then((response) => {

        this.categories = response.data

      }, (error) => {
        console.log(error)
      });

    }
  }
</script>
