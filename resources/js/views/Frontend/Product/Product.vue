<template>
<div class="text-left">
  <div class="font-bold py-4 pl-4 md:pl-8 lg:text-lg lg:pl-12">
    {{ product.collection.name }} / {{ product.category.name }}
  </div>
  
  <div class="grid md:grid-cols-2 items-start">

    <div class="flex flex-col-reverse lg:flex-row md:px-2 xl:px-5">
      <div class="flex gap-4 flex-wrap justify-center lg:flex-col md:pt-0 pt-4 md:pr-4">
        <div
          v-for="image, key in images"
          :key="key"
          class="
            border
            w-16
            h-16
            sm:w-20
            sm:h-20
            lg:w-26
            lg:h-26
            bg-cover bg-center
            cursor-pointer
          "
          @click="changeImage(image)"
          :style="{ backgroundImage: `url('/api/products/${image}')`}"
        ></div>
      </div>

      <div class="flex-grow">
        <img
          class="w-full"
          :src="`/api/products/${currentImage}`"
        />
      </div>
    </div>

    <div class="px-5 pt-3">
      <div
        class="
          text-xl
          font-bold
          uppercase
          border-b-4
          py-3
          border-red-100
          grid
          gap-3
        "
      >
        <div>
          {{ product.name }}
        </div>
        <div>
          S/. {{ product.sale_price }}
        </div>
      </div>

      <div class="uppercase text-lg border-b-4 py-3 border-red-100">
        <div v-if="product.color_id">
          <div>COLOR</div>
          <div class="flex mt-2 gap-3">
            <div class="w-6 h-6" :style="{'background-color': product.color.hex}"></div>
          </div>
        </div>

        <div class="mt-4">TALLA</div>
        <div class="flex mt-2 gap-3">
          <div class="cursor-pointer hover:bg-red-100 px-2">35</div>
          <div class="cursor-pointer hover:bg-red-100 px-2 bg-red-100">36</div>
          <div class="cursor-pointer hover:bg-red-100 px-2">37</div>
          <div
            class="
              cursor-pointer
              hover:bg-red-100
              px-2
              line-through
              text-gray-500
            "
          >
            38
          </div>
          <div class="cursor-pointer hover:bg-red-100 px-2">39</div>
          <div
            class="
              cursor-pointer
              hover:bg-red-100
              px-2
              line-through
              text-gray-500
            "
          >
            40
          </div>
        </div>
      </div>

      <div class="py-4 flex justify-between uppercase text-sm">
        <div class="">GUÍA DE TALLAS</div>
        <div class="">Este producto pertenece a la tabla A</div>
      </div>

      <div class="mt-4"></div>
      <div
        class="
          bg-red-100
          px-3
          py-3
          text-lg text-center
          hover:bg-red-200
          cursor-pointer
        "
        @click="addCart(product)"
      >
        AGREGAR AL CARRITO
      </div>

      <div class="mt-4"></div>
      <div
        class="flex gap-4 uppercase text-lg cursor-pointer hover:text-gray-500"
      >
        <div>
          <i class="far fa-heart"></i>
        </div>
        <div>Wishlist</div>
      </div>

      <div class="mt-4"></div>
      
      <DescriptionCollapse name="Descripción">
      </DescriptionCollapse>
      <DescriptionCollapse name="Materiales">
        - Cuero negro armado <br />
        - Planta de pu <br />
        - Forro de cuero <br />
        - Cordones negros y rojos <br />
      </DescriptionCollapse>
      <DescriptionCollapse name="Envios">
        - Cuero negro armado <br />
        - Planta de pu <br />
        - Forro de cuero <br />
        - Cordones negros y rojos <br />
      </DescriptionCollapse>
      <DescriptionCollapse name="Cambios y devoluciones">
        - Cuero negro armado <br />
        - Planta de pu <br />
        - Forro de cuero <br />
        - Cordones negros y rojos <br />
      </DescriptionCollapse>
      <DescriptionCollapse name="Limpieza y cuidados">
        - Cuero negro armado <br />
        - Planta de pu <br />
        - Forro de cuero <br />
        - Cordones negros y rojos <br />
      </DescriptionCollapse>

    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
import DescriptionCollapse from './Components/DescriptionCollapse.vue'

export default {
  
  components: {
    DescriptionCollapse,
  },

  mounted() {
    this.productId = this.$route.params.productId;

    this.fetchProductById(this.productId)
  },

  data() {
    return {
      // Image gallery index
      imageIndex: 0,
      // Product model
      productId: null,
      product: {},
    };
  },

  computed: {
    currentImage() {
      return this.images[this.imageIndex]
    },
    
    images() {
      return [
        this.product.image_url,
        this.product.image_second,
        this.product.image_third,
      ]
    },
  },

  methods: {
    changeImage (image) {
      this.imageIndex = this.images.findIndex(x => x == image)
    },

    addCart(product) {
      const router = this.$router
      axios.post('/api/shoppings', {
          productId: product.id
        }).then((response) => {
          router.push('/cart')
        })
    },
    
    fetchProductById(id) {
      axios.get('/api/product/' + id)
        .then(response => {
          this.product = response.data;
        });
    },
  },
};
</script>
