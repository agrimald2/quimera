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

    <div class="mt-4 bg-red-100 flex px-10 py-4 items-stretch relative">
      <div class="cursor-pointer absolute inset-y-0 left-0 hover:opacity-40	hover:bg-red-200 flex items-center">
        <div class="px-8 fas fa-caret-left" style="font-size:54px;"></div>
      </div>
      <div class="cursor-pointer absolute inset-y-0 right-0 hover:opacity-40 hover:bg-red-200 flex items-center">
        <div class="px-8 fas fa-caret-right" style="font-size:54px;"></div>
      </div>

      <div class="flex flex-grow gap-4">
        <div class="overflow-hidden flex gap-4">
          
          <div class="bg-white w-60 h-60 cursor-pointer"
            v-for="product in model"
            :key="product.id"
            @click="goProduct(product)">
              <img :src="'/api/products/' + product.image_url" alt="">
          </div>
          

        </div>
      </div>
      
    </div>

  </div>
</template>


<script>
export default {
  props: ["model"],
  methods: {
    goProduct (product) {
      window.location = '/item/' + product.id
    }
  }
}
</script>