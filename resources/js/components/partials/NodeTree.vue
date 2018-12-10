<template>
  <li>
    <a @click="loadCategory(node.id)"
       :class="activ_category == node.id ? 'is-active' : ''">
      {{ node.name }}
    </a> <!-- .is-active  -->
    <ul v-if="node.childs && node.childs.length">
      <node v-for="child in node.childs" :node="child" :key="child.id"></node>
    </ul>
  </li>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    name: 'node',
    props: {
      node: Object
    },
    computed: {
      ...mapState([
          'activ_category'
        ])
    },
    methods: {
      loadCategory(category_id) {

        this.$store.dispatch('update', category_id)

      }
    }
  }
</script>