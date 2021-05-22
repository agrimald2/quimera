<template>
<div id="card-product" class="bg-card h-100">
  <div class="card mb-0" style="border: 1px solid black">
    <header class="bg-white">
      <a :href="`/item/${product.id}`">
        <img :src="src" alt="producto" class="img-fluid">
      </a>
    </header>
    <div class="card-body pro-card" style="">
        <h2 class="card-title text-center">
          <a :href="`/item/${product.id}`">{{ product.name }}</a>
        </h2> 
        <h4 class="card-subtitle mb-2 text-center">
          S/ {{ product.sale_price.toFixed(2) }}
        </h4>
        <div class="form-row">
          <div class="col-6">
            <div class="mb-1 d-flex justify-content-end">
              <div type="button" class="btn btn-dark mr-1" style="width: 44px">
                <span class="lead text-nowrap text-center">
                   {{ quantity || 0 }}
                </span>
              </div>
              <button type="button" class="btn btn-dark mr-1" @click="decrement(); $forceUpdate()">
                <feather class="feather-sm" type="minus"/> 
              </button>
              <button type="button" class="btn btn-dark" @click="increment(); $forceUpdate()">
                <feather class="feather-sm" type="plus"/>
              </button>
            </div>
          </div>
          <div class="col d-flex align-items-center">
          <button @click="addCart(localProduct); $forceUpdate()" class="btn btn-dark">
            <feather class="feather-sm" type="shopping-cart"/>
            <span class="lead">
              Agregar 
            </span>
          </button>
        </div>
        </div>
        
    </div>
  </div>
</div>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  props: ['product'],
  mounted() {
    this.localProduct = Object.assign({
      counter: 0,
    }, this.product);
  },
  data() {
    return {
      localProduct: {},
      counter: 0,
      message: 'Agregar',
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
          total:null,
      },
      badge: 0,
      total_price: 0,
    }
  },
  created(){
    this.localStorageProduct()
    this.$eventHub.$on('reloadDetail', () => {
      if(localStorage.getItem('carts')){
          this.carts = JSON.parse(localStorage.getItem('carts'))
          this.badge = this.carts.length
          this.total_price = this.carts.reduce((total, item) => {
              return total + item.quantity * item.unit_price
          }, 0);
          localStorage.setItem('total', this.total_price);
      }
    })
  },
  computed: {
    src() {
      if (this.product.image_url) {
        return `/api/products/${this.product.image_url}`;
      } else {
        return "@/assets/img/1.jpg";
      }
    }
  },
  methods: {
    ...mapActions({
      addProduct: 'sale/addProduct',
      addProduct: 'sale/addProduct',
      plusProduct: 'sale/plusProduct',
      minusProduct: 'sale/minusProduct',
    }),
    localStorageProduct(){
      if(localStorage.getItem('carts')){
          this.carts = JSON.parse(localStorage.getItem('carts'))
          this.badge = this.carts.length
          this.total_price = this.carts.reduce((total, item) => {
              return total + item.quantity * item.unit_price
          }, 0);
          localStorage.setItem('total', this.total_price);
      }
      this.$eventHub.$emit('reloadData')
    },
    storeCartProduct(){
      let parsed = JSON.stringify(this.carts)
      localStorage.setItem('carts', parsed)
      this.localStorageProduct()
    },
    addCart(product){
      const searchProduct = this.carts.findIndex((item) => {
          return item.item_id === product.id;
      });

      if( searchProduct >= 0 ){
          let quantity = this.carts[searchProduct].quantity + parseInt(this.quantity)
          this.carts[searchProduct].quantity = quantity
          this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
          this.$snotify.info('Producto actualizado en el Carrito');
      }else{
          this.cart.item_id = product.id
          this.cart.image = product.image_url
          this.cart.name = product.name
          this.cart.description = product.description
          this.cart.unit_price = product.sale_price
          this.cart.quantity = this.quantity
          this.cart.total = this.quantity * product.sale_price
          this.carts.push(this.cart)
          this.$snotify.success('Se agrego el producto al carrito');
          this.cart = {}
          this.storeCartProduct()
      }
      localStorage.setItem('carts', JSON.stringify(this.carts));
      this.localStorageProduct()
      this.$eventHub.$emit('reloadCart')
    },
    decrement(){
        this.quantity = this.quantity - 1
        
        this.$eventHub.$emit('reloadData')
    },
    increment(){
        this.quantity = this.quantity + 1
        
        this.$eventHub.$emit('reloadData')
    },
    addP(product) {
      let doc = Object.assign({}, product);
      this.addProduct(doc);
      this.$snotify.success('Producto agregado');
      product.counter = 0;
      axios.post('shoppings', { product: doc }).catch(err => {
        console.log(err.response);
      });
    },
    plusP(product) {
      if (product.unit_code == 'KGM') {
        product.counter += 0.5;
      } else {
        product.counter += 1;
      }
    },
    minusP(product) {
      if (product.unit_code == 'KGM') {
        if (product.counter >= 0.5) {
          product.counter -= 0.5;
        }
      } else {
        if (product.counter >= 1) {
          product.counter -= 1;
        }
      }
    }
  }
}
</script>

<style scoped>
@media only screen and (max-width: 1400px) {
  #card-product {
    padding-left: 2rem !important;
    padding-right: 2rem !important;
  }   
}

</style>