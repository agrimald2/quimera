<template>
  <div class="col">
    <div class="col">
      <h1 style="color:white">PRODUCTOS</h1>
      <div class="form-group">
        <form @submit.prevent="searchProducts" class="search-input">
          <input type="text" v-model="key" class="form-control" placeholder="BUSCADOR" required>
        </form>
        <br>
        <button type="button" @click="clearFilters" class="btn btn-info">
                <feather type="x"/>
                Filtros
        </button>
        <!--TODO
        1. Filtros Precio
        2. Filtros por Categoría
        -->
      </div>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div class="btn-toolbar">
              <button class="btn btn-info" style="margin: 7px;">
                  <router-link class="btn btn-info" to="/products/create">
                    <feather type="plus"/>
                  </router-link>
              </button>
              <button class="btn btn-info" style="margin: 7px;">
                   <a href="/generateQR/product" target="_blank">Generar QR <i class="fa fa-qr"></i></a> 
              </button>
            </div>
          </div>
        </div>
        <hr>
        <div class="card-body row">
            <div class="card card-category  col-xl-3 col-md-4 col-12" v-for="item in products" :key='item.id'>
              
              <toggle-button style=" position: absolute; right: 10%; top: 5%;" :value="!disableds.find(e => e.product_id == item.id)" @change="disableProduct(item, $event.target.value)"></toggle-button>
              <img class="card-img-top" :src="'/api/products/'+item.image_url" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title" style="font-weight:bolder">
                  {{ item.name }}
                </h2>
                <div class="row">
                  <div class="col-2">
                    <div class="color-button" v-bind:style="{ 'background-color': item.color.hex}"></div>
                  </div>
                  <div class="col-10">
                    <h5>Talla - 36 </h5>
                  </div>
                </div>
                <h5 class="card-title">{{ item.category.name }}</h5>
                <h4 class="card-title">S/{{ item.sale_price.toFixed(2) }}</h4>
                <router-link :to="{ path: `/products/${item.id}/edit` }" class="mr-2">
                  <a href="#" class="btn btn-primary">Editar</a>
                </router-link>
                <a href="#" @click.prevent="deleteProduct(item.id)" class="btn btn-danger">Eliminar</a>
              </div>
            </div>
        </div>
        <div class="card-footer">
            <caption>
              <page-navigation v-model="page" :pages="pages" :count="count" :items="products.length" @confirm="fetchData"/>
            </caption>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .color-button{
    height: 20px;
    width: 20px;
  }
  img {
    justify-content: center;
    text-align: center;
  }
  p {
    color:whitesmoke
  }
  .card-category{
    align-items: center;
  }
</style>
<script>
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      disableds: [],
      products: [],
      page: 1,
      pages: null,
      count: null,
      key: null,
    }
  },
  methods: {
    clearFilters() {
      this.deleted = null;
      this.payed = null;
      this.delivered = null;
      this.fetchData();
    },
    deleteProduct(id) {
      var ok = confirm('Esta seguro de eliminar?...');
      if (ok) {
        axios.delete(`products/${id}`).then(res => {
          console.log(res);
          this.fetchData();
        });
      }
    },
    searchProducts() {
      axios.get(`products/${this.key}/search`).then(res => {
        console.log(res);
        this.products = res.data.products;
      }).catch(err => {
        console.log(err.response);
        this.$snotify.error(err.response.data);
      });
      this.key = '';
    },
    disableProduct(product) {
      let disabled = this.disableds.find(e => e.product_id == product.id);
      if (disabled) {
        axios.delete(`disableds/${disabled.id}`).then(res => {
          console.log(res);
          this.fetchData();
        });
      } else {
        disabled = { product_id: product.id };
        axios.post('disableds', { disabled }).then(res => {
          console.log(res);
          this.fetchData();
        });
      }
    },
    fetchData() {
      axios.get('disableds').then(res => {
        console.log(res);
        this.disableds = res.data.disableds;
      });
      var params = { page: this.page };
      axios.get('products', { params }).then(res => {
        console.log(res);
        this.products = res.data.products;
        this.pages = res.data.pages;
        this.count = res.data.count;
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>