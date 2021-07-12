<template>
  <div class="text-left">
    <div
      class="px-4 text-xl"
      style="
        font-family: 'Cedarville Cursive', cursive;
        font-size: 46px;
        margin-top: 148px;
      "
    >
    New in Store
    </div>

    <div class="overflow-hidden mt-4 bg-red-100 flex px-10 py-10 items-stretch relative">
      <div
        class="cursor-pointer absolute inset-y-0 left-0 bg-red-100 hover:bg-red-200 flex items-center"
        @click="move(240)">
        <div class="px-7 text-dark fas fa-caret-left" style="font-size:54px;"></div>
      </div>
      <div
        class="cursor-pointer absolute inset-y-0 right-0 bg-red-100 hover:bg-red-200 flex items-center"
        @click="move(-240)">
        <div class="px-7 text-dark fas fa-caret-right" style="font-size:54px;"></div>
      </div>

      <div ref="transition" class="transition flex flex-grow gap-4" :style="{ marginLeft: `${offset}px` }">
        
        <div class="bg-white w-60 h-60 cursor-pointer"
          v-for="product in model"
          :key="product.id"
          @click="goProduct(product)">
            <img :src="'/api/products/' + product.image_url" alt="">
        </div>

      </div>
      
    </div>

  </div>
</template>


<style scoped>
.transition {
  transition: margin-left 0.4s ease;
}
</style>

<script>
export default {
  props: ["model"],
  data () {
    return {
      offset: 0,
    }
  },
  methods: {
    goProduct (product) {
      window.location = '/item/' + product.id
    },
    move (qty) {
      const transitionWidth = this.$refs.transition.clientWidth + this.offset
      this.offset += qty
      
      if (this.offset < -transitionWidth)
        this.offset = 0
      
      this.offset = Math.min(0, this.offset)
    }
  },
}
</script>