<template>
  <div class="text-left px-4 lg:max-w-screen-lg mx-auto">
    <div class="border-b-2 border-red-100 py-4 font-bold px uppercase">
      Carrito de compras
    </div>

    <div class="text-2xl text-center text-gray-400 font-normal py-7" v-show="!products.length">
      ¡No hay productos en el Carrito!
    </div>

    <div
      class="border-b-2 border-red-100 flex"
      v-for="i in products"
      :key="i.id">
      <div class="w-1/3 flex items-center justify-center">
        <img
          style="max-height: 250px"
          :src="'/api/products/' + i.product.image_url"
          class="w-auto"
        />
      </div>
      <div
        class="
          md:flex-grow
          py-4
          flex flex-col
          md:items-center
          md:flex-row
          md:text-lg
          md:justify-between
          md:px-4
        "
      >
        <div class="font-bold grid md:grid-cols-2 gap-1 md:gap-5">
          <div class="">{{ i.product.name }}</div>
          <div class="">COLOR: {{ i.product.color }}</div>
          <div class="">TALLA: {{ i.product.size }}</div>
          <div class="">CANTIDAD: {{ i.counter }}</div>
          <div class="">PRECIO: S/. {{ i.product.sale_price }}</div>
        </div>
        <div
          class="mt-3 flex items-center text-gray-800 gap-3 font-normal cursor-pointer hover:text-gray-500"
          @click="removeFromCart(i.product)"
        >
          <div class="fas fa-trash"></div>
          Quitar
        </div>
      </div>
    </div>

    <div
      class="
        mt-4
        grid
        md:grid-cols-2
        lg:grid-cols-3
        gap-3
        lg:max-w-screen-lg
        mx-auto
      "
    >
      <div
        class="
          md:col-span-2
          lg:col-span-1
          border-2 border-red-100
          px-4
          py-4
          text-center
          font-bold
          uppercase
          cursor-pointer
          hover:bg-red-100
        "
        @click="$router.push('/store')"
      >
        ACTUALIZAR CARRITO
      </div>

      <div
        style="min-height: 64px;"
        class="border-2 border-red-100 font-bold uppercase flex items-stretch"
      >
        <div
          class="
            flex-grow
            bg-red-100
            flex
            items-center
            justify-center
            hover:bg-red-200
            cursor-pointer
            px-3
          "
        >
          APLICAR
        </div>
        <input
          placeholder="Código de descuento "
          type="text"
          class="flex-grow px-4 uppercase"
        />
      </div>

      <div
        class="
          px-4
          py-4
          text-center
          font-bold
          uppercase
          cursor-pointer
          hover:bg-red-200
          bg-red-100
        "
      >
        COMPRAR
      </div>
    </div>
  </div>
</template>



<script>
import axios from 'axios'

export default {

  mounted() {
    this.fetchData()
  },
  
  data () {
    return {
      products: {},
    }
  },

  methods: {
    fetchData() {
      axios.get('api/shoppings')
        .then(x => this.products = x.data.shoppings);
    },

    removeFromCart(product)
    {
      axios.delete('api/shoppings/' + product.id)
        .then(x => this.products = x.data.shoppings)
    }
  }

}
</script>