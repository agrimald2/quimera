<template>
  <div class="col">
    <!--Modal-->
      <div  class="descuento" :class="{'mostrar' : desct}" style="overflow-y: auto;padding-top: 50px;">
          <div class="descuento-content">
              <div class="modal-header">
                <h2>Ingresar Descuento</h2>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="form-group">
                          <label>Fecha Inicial</label>
                          <input type="date" class="form-control" v-model="initial_date">
                      </div>
                      <div class="form-group">
                          <label>Fecha Final</label>
                          <input type="date" class="form-control" v-model="final_date">
                      </div>
                      <div class="form-group">
                          <label>Porcentaje</label>
                          <input type="number" class="form-control" v-model="porcentaje">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" @click="PostDescuento">Registrar Descuento</button>
                  <button type="button" class="btn-danger" @click="Cerrar">Cerrar</button>
              </div>
          </div>            
      </div>
    <!--Cerrar Modal-->
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
            <div class="card card-category  col-xl-3 col-md-4 col-12" v-for="item in products" :key='item.products.id'>
              
              <toggle-button style=" position: absolute; right: 10%; top: 5%;" :value="!disableds.find(e => e.product_id == item.products.id)" @change="disableProduct(item.products, $event.target.value)"></toggle-button>
              <img class="card-img-top" :src="'/api/products/'+item.products.image_url" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title" style="font-weight:bolder">
                  {{ item.products.name }}
                </h2>
                <div class="row">
                  <div class="col-2">
                    <div class="color-button" v-bind:style="{ 'background-color': item.products.color.hex}"></div>
                  </div>
                  <div class="col-10">
                    <h5>Talla - 36 </h5>
                  </div>
                </div>
                <h5 class="card-title">{{ item.products.category.name }}</h5>
                <h4 class="card-title">S/{{ item.products.sale_price.toFixed(2) }}</h4> 
                <h4 class="card-title">Descuento : {{ result_desc=parseFloat(item.products.sale_price - (item.porcentaje*item.products.sale_price)/100).toFixed(2)  }} </h4>
                <router-link :to="{ path: `/products/${item.products.id}/edit` }" class="mr-2">
                  <a href="#" class="btn btn-primary">Editar</a>
                </router-link>
                <a href="#" @click.prevent="deleteProduct(item.products.id)" class="btn btn-danger">Eliminar</a>
                <a href="#" @click="Modal(item.products.id)" class="btn btn-info">% Descuento</a>
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
    height: 30vh;
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
      products_id:'',
      initial_date:'',
      final_date:'',
      porcentaje:'',
      desct:0,
      result_desc:'',
      pages: null,
      count: null,
      key: null,
    }
  },
  methods: {

    Modal(id){
      this.products_id = id;
      this.desct = 1;
    },

    Cerrar(){
      this.desct = 0;
    },

    PostDescuento(){
        axios.post('asign_descuento', { 
          products_id: this.products_id,
          initial_date : this.initial_date,
          final_date : this.final_date,
          porcentaje : this.porcentaje
        }).then(res => {
          console.log(res.data);
          this.desct=0;
          this.$snotify.success('registrado correctamente');
          //this.$router.replace('/deliveries')
        }).catch(err => {
          console.log(err.response);
        });
    },  

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

    .descuento.mostrar {
      background-color: rgba(0,0,0,.5);
      opacity: 1;
      visibility: visible;
    }
    .descuento {
      align-items: flex-start;
      background-color: #fff;
      display: flex !important;
      height: 100vh;
      justify-content: center;
      left: 0;
      opacity: 0;
      position: fixed;
      top: 0;
      visibility: hidden;
      width: 100%;
      transition: all 0.40s cubic-bezier(0.39, 0.575, 0.565, 1);
      z-index: 5000;
    }

    .descuento.mostrar .descuento-content {
        opacity: 1;
        transform: scale(1.1);
        visibility: visible;
    }
    .descuento .descuento-content {
        border-radius: 3px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        margin-top: 50px;
        opacity: 0;
        padding: 4px;
        transform: scale(1);
        transition: all .40s cubic-bezier(0.39, 0.575, 0.565, 1);
        visibility: hidden;
    }

</style>