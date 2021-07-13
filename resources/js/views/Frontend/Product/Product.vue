<template>
<div class="text-left">
  <div class="font-bold py-4 pl-4 md:pl-8 lg:text-lg lg:pl-12">
    {{ record.collection.name }} / {{ record.category.name }}
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
          {{ record.name }}
        </div>
        <div>
          S/. {{ record.discount.porcentage ? result_desc=parseFloat(record.sale_price - (record.discount.porcentage*record.sale_price)/100).toFixed(2) : record.sale_price  }}
        </div>
      </div>

      <div class="uppercase text-lg border-b-4 py-3 border-red-100">
        <div v-if="record.color_id">
          <div>COLOR</div>
          <div class="flex mt-2 gap-3">
            <div class="w-6 h-6" :style="{'background-color': record.color.hex}"></div>
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
        @click="addCart(record)"
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
import { mapGetters, mapActions } from "vuex";
import CustomerModal from "@/components/CustomerModal";
import CheckoutModal from "@/components/CheckoutModal";
import swal from "sweetalert";

import DescriptionCollapse from './Components/DescriptionCollapse.vue'

export default {
  components: {
    DescriptionCollapse,
    
    CustomerModal,
    CheckoutModal,
    swal,
  },
  mounted() {
    var productId = this.$route.params.productId;
    this.product_id = productId;
    axios.get(`/product/${this.product_id}`).then((res) => {
      this.record = res.data;
    });
    //this.fetchData();
    var count_storage = JSON.parse(localStorage.getItem("carts"));
    var count = count_storage.length;
    this.count = count;
    console.log(this.count);
  },
  data() {
    return {
      disableds: [],
      products: [],
      categories: [],
      colors: [],
      sizes: [],
      items: [],
      collections: [],
      product_id: null,
      key: null,
      page: 0,
      itemsPerPage: 18,
      boolean: false,
      record: {},
      quantity: 1,
      carts: [],
      cart: {
        item_id: null,
        description: null,
        unit_price: null,
        quantity: null,
        size: null,
        color: null,
        image: null,
        total: null,
      },
      badge: 0,
      total_price: 0,
      count: "",


      // Gallery
      imageIndex: 0,
    };
  },
  created() {
    this.localStorageProduct();
    this.$eventHub.$on("reloadDetail", () => {
      if (localStorage.getItem("carts")) {
        this.carts = JSON.parse(localStorage.getItem("carts"));
        this.badge = this.carts.length;
        this.total_price = this.carts.reduce((total, item) => {
          return total + item.quantity * item.unit_price;
        }, 0);
        localStorage.setItem("total", this.total_price);
      }
    });
  },
  computed: {
    ...mapGetters({
      sale: "sale/getSale",
      totalProducts: "sale/totalProducts",
    }),
    currentImage() {
      return this.images[this.imageIndex]
    },
    images() {
      return [
        this.record.image_url,
        this.record.image_second,
        this.record.image_third,
      ]
    }
  },
  methods: {
    ...mapActions({
      removeAllProducts: "sale/removeAllProducts",
      addProduct: "sale/addProduct",
      plusProduct: "sale/plusProduct",
      removeProduct: "sale/removeProduct",
      setSale: "sale/setSale",
      minusProduct: "sale/minusProduct",
    }),
    
    changeImage (image) {
      this.imageIndex = this.images.findIndex(x => x == image)
    },

    localStorageProduct() {
      if (localStorage.getItem("carts")) {
        this.carts = JSON.parse(localStorage.getItem("carts"));
        this.badge = this.carts.length;
        this.total_price = this.carts.reduce((total, item) => {
          return total + item.quantity * item.unit_price;
        }, 0);
        localStorage.setItem("total", this.total_price);
      }
      this.$eventHub.$emit("reloadData");
    },
    storeCartProduct() {
      let parsed = JSON.stringify(this.carts);
      localStorage.setItem("carts", parsed);
      this.localStorageProduct();
    },
    addCart(product) {
      const searchProduct = this.carts.findIndex((item) => {
        return item.item_id === product.id;
      });

      if (searchProduct >= 0) {
        let quantity =
          this.carts[searchProduct].quantity + parseInt(this.quantity);
        this.carts[searchProduct].quantity = quantity;
        //this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
        this.carts[searchProduct].total =
          this.carts[searchProduct].quantity *
          this.carts[searchProduct].discount.porcentage
            ? parseFloat(
                this.carts[searchProduct].unit_price -
                  (this.carts[searchProduct].discount.porcentage *
                    this.carts[searchProduct].unit_price) /
                    100
              ).toFixed(2)
            : this.carts[searchProduct].unit_price;
        // this.carts[searchProduct].porcentage ? parseFloat(this.carts[searchProduct].unit_price - (this.carts[searchProduct].porcentage*this.carts[searchProduct].unit_price)/100).toFixed(2) : this.carts[searchProduct].unit_price
        //this.$snotify.info('Producto actualizado en el Carrito');
        swal({
          title: "Genial!!",
          text: "Producto Actualizado en el Carrito",
          icon: "success",
          buttons: false,
        });
      } else {
        this.cart.item_id = product.id;
        this.cart.image = product.image_url;
        this.cart.name = product.name;
        this.cart.description = product.description;
        this.cart.unit_price = product.discount.porcentage
          ? parseFloat(
              product.sale_price -
                (product.discount.porcentage * product.sale_price) / 100
            ).toFixed(2)
          : product.sale_price;
        this.cart.quantity = this.quantity;
        this.cart.total =
          this.quantity * product.discount.porcentage
            ? parseFloat(
                product.sale_price -
                  (product.discount.porcentage * product.sale_price) / 100
              ).toFixed(2)
            : product.sale_price;
        this.carts.push(this.cart);
        //this.$snotify.success('Se agrego el producto al carrito');
        swal({
          title: "Genial!!",
          text: "Se agrego el producto al carrito",
          icon: "success",
          buttons: false,
        });
        this.cart = {};
        this.storeCartProduct();
      }
      localStorage.setItem("carts", JSON.stringify(this.carts));
      this.localStorageProduct();
      this.$eventHub.$emit("reloadCart");
    },
    src(item) {
      if (item.image_url) {
        return `/api/products/${item.image_url}`;
      } else {
        return "@/assets/img/1.jpg";
      }
    },
    searchBy(key, id) {
      axios.get("products/" + key + "/" + id + "/searchBy").then((res) => {
        console.log("filtro by characteristic", res);
        this.items = res.data.products;
      });
    },
    checkDelivery() {
      $("#shoppingModal").modal("show");
    },
    removeP(product) {},
    plusP(product) {},
    minusP(product) {},
    successCheckout(data) {},
    errorCheckout(error) {
      console.log(data);
    },
    submit(sale) {},
    fetchData() {
      axios.get("categories").then((res) => {
        console.log("categories store", res);
        this.categories = res.data.categories;
      });
      axios.get("colors").then((res) => {
        console.log("colors store", res);
        this.colors = res.data.colors;
      });
      axios.get("sizes").then((res) => {
        console.log("sizes store", res);
        this.sizes = res.data.sizes;
      });
      axios.get("collections").then((res) => {
        console.log("collections store", res);
        this.collections = res.data.collections;
      });
      axios.get("shoppings").then((res) => {
        console.log(res);
        this.removeAllProducts();
        var shoppings = res.data.shoppings;
        shoppings.forEach((item) => {
          var product = item.product;
          console.log(product);
          if (product) {
            product.counter = item.counter;
            console.log(product);
            this.addProduct(product);
          }
        });
      });
      axios.get("disableds/shop").then((res) => {
        console.log(res);
        this.disableds = res.data.disableds;
        axios.get("products/all").then((res) => {
          console.log(res);
          this.products = res.data.products.filter(
            (item) => !this.disableds.find((e) => e.product_id == item.id)
          );
        });
      });
    },
  },
};
</script>

<style scoped>
.btn-red {
  background: red;
}

.social {
  color: #f3ecec;
  width: 56px;
  padding: 14px;
  margin: 10px;
  position: fixed;
  top: 277px;
  right: -15px;
  background: #e0d4d4;
  border-radius: 10px;
  z-index: 1000;
}
.social .shopcart-icon {
  font-size: 15px;
  position: relative;
  text-transform: uppercase;
  line-height: 6px;
  color: #191717;
  padding-top: 13px;
}

.social .count {
  position: absolute;
  display: inline-block;
  text-align: center;
  width: 37px;
  height: 19px;
  border-radius: 50%;
  top: -3px;
  right: -1px;
  color: #ffffff;
  font-size: 17px;
  line-height: 22px;
}
</style>