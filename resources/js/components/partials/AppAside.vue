<template>
  <aside class="menu">
    <p class="menu-label">
      Menu
    </p>
    <ul class="menu-list">
      <li>
        <a @click="update" :class="!activ_category ? 'is-active' : ''">All products</a>
      </li>
      <node-tree v-for="category in categories" :node="category" :key="category.id"></node-tree>
    </ul>
  </aside>
</template>

<script>
  import request from '../../services/request'
  import NodeTree from './NodeTree'
  import { mapState } from 'vuex'

  export default {
    components: {
      NodeTree
    },
    data() {
      return {
      }
    },
    computed: {
      ...mapState([
          'activ_category',
          'categories'
        ])
    },
    methods: {
      update() {
        this.$store.dispatch('update')
      }
    },
    mounted() {
      this.$store.dispatch('updateCats')
    }
  }
</script>
