<template>
      <div class="row" id="card-product">
        <div class="col-lg-12">
          <div class="tg-ad tg-verifiedad" style="box-shadow: 0 0 15px 0 rgba(0,0,0,0.20);">
            <figure>
              <a :href="`/item/${product.id}`">
                <img  :src="src" style="width: 100%;">
              </a>
              <span class="tg-photocount">
                <a :href="`/item/${product.id}`" style="font-size: 25px;">{{ product.name }}</a>
              </span>
            </figure>
            <div class="tg-adcontent">
              <ul class="tg-productcagegories">
                <li style="margin-left: 45px;">
                  S/ {{ product.sale_price.toFixed(2) }}
                </li>
              </ul>
              <div class="container" style="margin: 24px;">
                <div class="row">

                  <div class="quantity-toggle" style="margin: 11px;padding-top: 0px;margin-left: 56px;">
                    <button @click="decrement(); $forceUpdate()" class="btn btn-info" style="background: #e0cfc7ff;    border-color: #e0cfc7ff;">&mdash;</button>
                    {{ quantity || 0 }}
                    <button @click="increment(); $forceUpdate()" class="btn btn-info" style="background: #e0cfc7ff;    border-color: #e0cfc7ff;">&#xff0b;</button>
                  </div>

                </div>
              </div>
              <div class="tg-phonelike" style="padding: 0 0 0 0 !important;">
                <a class="tg-btnphone" style="background-color: #e0cfc7ff; color:#fff"  @click="addCart(localProduct); $forceUpdate()">
                  <i class="icon-cart"></i>
                  <span data-toggle="tooltip" data-placement="top">
                    <em>Agregar</em>
                  </span>
                </a>
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

@media (max-width:767px){

  #card-product{
    margin-top: 40px !important;
  }

  .tg-productcagegories li{
      margin-left: -3px !important;
  }

  .quantity-toggle{
    margin-left: 9px !important;
  }

}

.tg-ad.tg-verifiedad .tg-adtitle:before{display: block;}
.tg-adcontent{
  width: 100%;
}
.tg-productcagegories{
    width: 100%;
    font-size: 22px;
    list-style: none;
    margin: 0px 0 39px;
    padding: -1px 0 10px;
    border-bottom: 1px solid #dbdbdb;
}
.tg-productcagegories li{
  float: left;
  line-height: inherit;
  list-style-type: none;
}
.tg-productcagegories li a{color: #363b4d;font-style: 16px;}
.tg-productcagegories li a:hover{color: #55acee;}
.tg-adtitle{
  width: 100%;
  float: left;
  position: relative;
  padding: 0 32px 6px 0;
}
.tg-phonelike{
  width: 100%;
  float: left;
  height: 33px;
  margin: -24px 0 0;
  position: relative;
  padding: 0 38px 0 0;
}
.tg-btnphone{
  width: 100%;
  float: left;
  color: #363b4d;
  border-radius: 3px;
  text-align: center;
  background: #f7f7f7;
}
.tg-btnphone:hover,
.tg-btnphone:focus{color: #fff;}
.tg-btnphone i,
.tg-btnphone span{
  display: inline-block;
  vertical-align: middle;
}
.tg-btnphone:hover i,
.tg-btnphone:focus i{color: #fff;}
.tg-btnphone i,
.tg-btnphone span,
.tg-btnphone span em{
  font-size: 14px;
  line-height: 33px;
  font-style: normal;
}
.tg-btnphone i{
  font-size: 16px;
  padding: 0 5px 0 0;
}

.mb-1, .my-1 {
    margin-bottom: 1.25rem!important;
}

</style>