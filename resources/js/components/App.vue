<template>
  <div class="wrapper">
    
    <app-nav></app-nav>

    <div class="columns is-mobile is-multiline">
      <div class="column is-12-mobile is-4-tablet">
        
        <app-aside></app-aside>

      </div>
      <div class="column is-12-mobile is-8-tablet">
        
        <app-products></app-products>

      </div>
    </div>
  </div>
</template>

<script>
  import AppAside from './partials/AppAside.vue'
  import AppProducts from './partials/AppProducts.vue'
  import AppNav from './partials/AppNav.vue'

  export default {
    components: {
      AppAside,
      AppProducts,
      AppNav
    }
  }
</script>
