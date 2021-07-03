<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="container d-flex flex-column" style="position: relative;">
          <label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">{{record.collection.name}} / {{record.category.name}}</label>
              <div class="row d-flex justify-content-center w-100" style="color: black;">
                  <div class="pb-3 pt-3 pl-3 pr-3 col-md-5">
                      <img :src="src(record)" style="width: 100%; height:100%">
                  </div>
                  <div class="d-flex flex-column pb-3 pt-3 pl-3 pr-3 col-md-5" style="font-size: 12px">
                      <div class="d-flex flex-column pb-2 pt-2">
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;font-size: 32px;">{{record.name}}</label>
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;font-size: 17px;">S/. {{ record.discount.porcentage ? result_desc=parseFloat(record.sale_price - (record.discount.porcentage*record.sale_price)/100).toFixed(2) : record.sale_price  }} </label>                    
                    </div>
                    <div class="d-flex flex-column" style="border-top: 1px solid">
                        <div v-if="record.color_id">
                          <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">COLOR</label>
                          <div class="col-3">
                            <input type="checkbox" />
                            <label>{{record.color.name}}</label>
                          </div>
                        </div>
                        <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">TALLA</label>
                        <div class="col-3">
                          <input type="checkbox" />
                          <label>Talla 1</label>
                        </div>
                      <div class="d-flex pb-2 pt-2" style="border-top: 1px solid">
                          <p><label class="text-left" for="card_name" style="margin-bottom: 0px;">GUIA DE TALLAS</label></p>
                          <label class="text-right" for="card_name" style="margin-bottom: 0px;">ESTE PRODUCTO PERTENECE A LA TABLA A</label>
                      </div>
                      <div class="d-flex flex-column pb-2 pt-2 w-75">
                          <button class="btn button-pink w-100" @click="addCart(record)">
                              AGREGAR AL CARRITO
                          </button>
                      </div>
                      <div class="d-flex pb-2 pt-2">
                        <img src="@/assets/img/quimera/heart.png" class="mr-2" style="width: 5%;">
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">WISHLIST</label>
                      </div>
                      <div class="d-flex flex-column pb-2 pt-2">
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;background: #e0cfc7ff;
                          padding: 5px;
                          width: 21%;">DESCRIPCION</label>
                          <p>{{record.description}}</p>
                          <br>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">DETALLES Y MATERIALES</label><br>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">ENVIOS</label><br>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">CAMBIOS Y DEVOLUCIONES</label><br>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">LIMPIEZA Y CUIDADO</label><br>
                      </div>
                    </div>
                  </div> 
              </div> 
          </section>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import CustomerModal from '@/components/CustomerModal'
import CheckoutModal from '@/components/CheckoutModal'
import swal from 'sweetalert';


export default {
  components: {
    CustomerModal,
    CheckoutModal,
    swal,
  },
  mounted() {
    var productId = this.$route.params.productId;
    this.product_id = productId;
    axios.get(`/product/${this.product_id}`).then(res => {
      this.record = res.data
    })
    //this.fetchData();
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
    ...mapGetters({
      sale: 'sale/getSale',
      totalProducts: 'sale/totalProducts',
    }),
    
  },
  methods: {
    ...mapActions({
      removeAllProducts: 'sale/removeAllProducts',
      addProduct: 'sale/addProduct',
      plusProduct: 'sale/plusProduct',
      removeProduct: 'sale/removeProduct',
      setSale: 'sale/setSale',
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
          //this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
          this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].discount.porcentage ? parseFloat(this.carts[searchProduct].unit_price - (this.carts[searchProduct].discount.porcentage*this.carts[searchProduct].unit_price)/100).toFixed(2) : this.carts[searchProduct].unit_price;
         // this.carts[searchProduct].porcentage ? parseFloat(this.carts[searchProduct].unit_price - (this.carts[searchProduct].porcentage*this.carts[searchProduct].unit_price)/100).toFixed(2) : this.carts[searchProduct].unit_price 
          //this.$snotify.info('Producto actualizado en el Carrito');
          swal({
            title: "Genial!!",
            text: "Producto Actualizado en el Carrito",
            icon: "success",
            buttons:false,
          });
      }else{
          this.cart.item_id = product.id
          this.cart.image = product.image_url
          this.cart.name = product.name
          this.cart.description = product.description
          this.cart.unit_price = product.discount.porcentage ? parseFloat(product.sale_price - (product.discount.porcentage*product.sale_price)/100).toFixed(2) : product.sale_price 
          this.cart.quantity = this.quantity
          this.cart.total = this.quantity * product.discount.porcentage ? parseFloat(product.sale_price - (product.discount.porcentage*product.sale_price)/100).toFixed(2) : product.sale_price 
          this.carts.push(this.cart)
          //this.$snotify.success('Se agrego el producto al carrito');
          swal({
            title: "Genial!!",
            text: "Se agrego el producto al carrito",
            icon: "success",
            buttons:false,
          });
          this.cart = {}
          this.storeCartProduct()
      }
      localStorage.setItem('carts', JSON.stringify(this.carts));
      this.localStorageProduct()
      this.$eventHub.$emit('reloadCart')
    },
    src(item) {
      if (item.image_url) {
        return `/api/products/${item.image_url}`;
      } else {
        return "@/assets/img/1.jpg";
      }
    },
    searchBy(key,id) {
      axios.get('products/'+key+'/'+id+'/searchBy').then(res => {
        console.log('filtro by characteristic', res);
        this.items = res.data.products;
      });
    },
    checkDelivery() {
      $('#shoppingModal').modal('show');
    },
    removeP(product) {
      
    },
    plusP(product) {
      
    },
    minusP(product) {
      
    },
    successCheckout(data) {
      
    },
    errorCheckout(error) {
      console.log(data);
    },
    submit(sale) {
      
    },
    fetchData() {
      axios.get('categories').then(res => {
        console.log('categories store', res);
        this.categories = res.data.categories;
      });
      axios.get('colors').then(res => {
        console.log('colors store', res);
        this.colors = res.data.colors;
      });
      axios.get('sizes').then(res => {
        console.log('sizes store', res);
        this.sizes = res.data.sizes;
      });
      axios.get('collections').then(res => {
        console.log('collections store', res);
        this.collections = res.data.collections;
      });
      axios.get('shoppings').then(res => {
        console.log(res);
        this.removeAllProducts();
        var shoppings = res.data.shoppings;
        shoppings.forEach(item => {
          var product = item.product;
          console.log(product);
          if (product) {
            product.counter = item.counter;
            console.log(product);
            this.addProduct(product);
          }
        });
      });
      axios.get('disableds/shop').then(res => {
        console.log(res);
        this.disableds = res.data.disableds;
        axios.get('products/all').then(res => {
          console.log(res);
          this.products = res.data.products.filter(item => !this.disableds.find(e => e.product_id == item.id));
        });
      });
    },
  }
}
</script>

<style scoped>
  
</style>