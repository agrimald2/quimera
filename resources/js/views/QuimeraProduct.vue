<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="d-flex flex-column" style="position: relative;">
          <label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">{{record.collection.name}} / {{record.category.name}}</label>
              <div class="row d-flex justify-content-center w-100">
                  <div class="pb-3 pt-3 pl-3 pr-3 col-md-5">
                      <img :src="src(record)" style="width: 100%; height:100%">
                  </div>
                  <div class="d-flex flex-column pb-3 pt-3 pl-3 pr-3 col-md-5" style="font-size: 12px">
                      <div class="d-flex flex-column pb-2 pt-2">
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">{{record.name}}</label>
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">S/. {{record.sale_price}}</label>
                    </div>
                    <div class="d-flex flex-column" style="border-top: 1px solid">
                        <div v-if="record.color_id">
                          <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">COLOR</label>
                          <div class="d-flex">
                            <input type="checkbox" />
                            <label>{{record.color.name}}</label>
                          </div>
                        </div>
                        <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">TALLA</label>
                        <div class="d-flex pb-2">
                          <input type="checkbox" />
                        </div>
                      <div class="d-flex pb-2 pt-2" style="border-top: 1px solid">
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">GUIA DE TALLAS</label>
                          <label class="text-right" for="card_name" style="margin-bottom: 0px;">ESTE PRODUCTO PERTENECE A LA TABLA A</label>
                      </div>
                      <div class="d-flex flex-column pb-2 pt-2 w-75">
                        <a type="submit" href="#" class="btn button-pink w-100">
                        AGREGAR AL CARRITO
                        </a>
                      </div>
                      <div class="d-flex pb-2 pt-2">
                        <img src="@/assets/img/quimera/heart.png" class="mr-2 newsletter-img">
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">WISHLIST</label>
                      </div>
                      <div class="d-flex flex-column pb-2 pt-2">
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">DESCRIPCION</label>
                          <p>{{record.description}}</p>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">DETALLES Y MATERIALES</label>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">ENVIOS</label>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">CAMBIOS Y DEVOLUCIONES</label>
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">LIMPIEZA Y CUIDADO</label>
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

export default {
  components: {
    CustomerModal,
    CheckoutModal,
  },
  mounted() {
    var productId = this.$route.params.productId;
    this.product_id = productId;
    axios.get(`/product/${this.product_id}`).then(res => {
      console.log('categories store', res.data)
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
      record: {}
    }
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