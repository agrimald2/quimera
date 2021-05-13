<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="d-flex" style="position: relative;">
          <div class="row store-flex">
            <div class="col-lg-2">
              <div class="sidebar d-md-block" style="text-align: start; padding: 0px 10px">
                <div class="sidebar-wrapper">
                  <div class="logo mb-4">
                    <a href="javascript:void(0)" style="color: black" class="simple-text logo-normal">
                      FILTRAR POR:  
                    </a>
                  </div>
                  <ul class="nav flex-column">
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navCategoria" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">CATEGORIA</a>
                        <ul class="collapse list-unstyled" id="navCategoria" style="padding-top: 10px;">
                          <li class="nav-item" v-for="item in categories" :key="item.id">
                            <a class="nav-link font-black" href="#" @click.prevent="searchBy('category_id',item.id)">{{ item.name }}</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navTalla" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">TALLA</a>
                        <ul class="collapse list-unstyled" id="navTalla" style="padding-top: 10px;">
                          <li class="nav-item" v-for="item in sizes" :key="item.id">
                            <a class="nav-link font-black" href="#" @click.prevent="searchBy('size_id',item.id)">{{ item.name }}</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navColor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">COLOR</a>
                        <ul class="collapse list-unstyled" id="navColor" style="padding-top: 10px;">
                          <li class="nav-item" v-for="item in colors" :key="item.id">
                            <a class="nav-link font-black" href="#" @click.prevent="searchBy('color_id',item.id)">{{ item.name }}</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navColeccion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">COLECCION</a>
                        <ul class="collapse list-unstyled" id="navColeccion" style="padding-top: 10px;">
                          <li class="nav-item" v-for="item in collections" :key="item.id">
                            <a class="nav-link font-black" href="#" @click.prevent="searchBy('collection_id',item.id)">{{ item.name }}</a>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
             </div> 
            <div class="col-lg-10 d-flex" style="flex-wrap: wrap;">
              <div v-for="item in items" :key="item.id" class="col-lg-4" style="padding-bottom: 15px;">
                <div class="d-flex flex-column" style="align-items: center;">
                  <a :href="`/item/${item.id}`"><img :src="src(item)" alt="producto" style="width: 100%;border: 1px solid #e0cfc7ff;"></a>
                  <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">{{ item.name }}</label>
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
    var categoryId = this.$route.params.categoryId;
    this.category_id = categoryId;
    console.log('este el el id ', this.category_id);
    if(this.category_id > 0){
      this.searchBy('category_id',this.category_id);
    }else{
      axios.get('products/all').then(res => {
        console.log(res);
        this.items = res.data.products;
      });  
    }
    this.fetchData();
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
      category_id: null,
      key: null,
      page: 0,
      itemsPerPage: 18,
      boolean: false,
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