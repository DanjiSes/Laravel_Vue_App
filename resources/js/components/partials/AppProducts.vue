<template>
  <main>
    <h1 class="title">Products</h1>
    <ul class="columns is-mobile is-multiline">

      <li class="column is-half-mobile is-4-tablet product"
          v-for="product in products">

        <img :src="product.image" alt="">
        <h2 class="subtitle">{{ product.name }}</h2>
        <p>{{ product.descript }}</p>

      </li>

    </ul>
  </main>
</template>

<script>
  import request from '../../services/request'
  import { mapState } from 'vuex'

  export default {
    components: {
    },
    data() {
      return {
        // products: []
      }
    },
    computed: {
      ...mapState([
          'products'
        ])
    },
    mounted() {
      
      this.$store.dispatch('update')

    }
  }
</script>
