<template>
  <div>
    <Brands />
    <Types :model="data.categories" />
    <NewInStore :model="data.products" />
    <Instagram />
  </div>
</template>


<script>
import Brands from './Components/Brands.vue'
import Types from './Components/Types.vue'
import NewInStore from './Components/NewInStore.vue'
import Instagram from './Components/Instagram.vue'

import axios from 'axios'

export default {
  components: {
    Brands,
    Types,
    NewInStore,
    Instagram,
  },
  mounted(){
    this.fetchData()
  },
  data(){
    return {
      data: {}
    }
  },
  methods: {
    fetchData() {
      axios.get('/api/frontend/')
        .then(res => this.data = res.data)
    }
  }
}
</script>