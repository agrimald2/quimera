<template>
  <div class="col">
    <!--Modal-->
      <div  class="descuento" :class="{'mostrar' : desct}" style="overflow-y: auto;padding-top: 50px;">
          <div class="descuento-content">
              <div class="modal-header">
                <h2>Ingresar Descuento</h2>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="row">
                          <label>Fecha Inicial</label>
                          <input type="date" class="form-control" v-model="initial_date">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <label>Fecha Final</label>
                          <input type="date" class="form-control" v-model="final_date">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <label>Porcentaje</label>
                          <input type="number" class="form-control" v-model="porcentaje">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" @click="PostDescuento()">Registrar Descuento</button>
                  <button type="button" class="btn-danger" @click="Cerrar">Cerrar</button>
              </div>
          </div>            
      </div>
    <!--Cerrar Modal-->
    <div class="col">
      <div class="card">
          <div class="card-header">
              <h1 style="color:white">PRODUCTOS</h1>
          </div>
      </div>
      
      <div class="form-group row">
        <div class="col-6">
            <form @submit.prevent="searchProducts" class="search-input">
              <input type="text" v-model="key" class="form-control" placeholder="BUSCADOR">
            </form>
        </div>
        <div class="col-6">
            <button type="button" @click="filtres=!filtres" class="btn btn-info">
                <i class="fas fa-filter"></i>
                Filtrar Búsqueda
            </button>
        </div>        
        <br>
        
        
        <!--TODO
        1. Filtros Precio
        2. Filtros por Categoría, Coleccion y Color
        -->
      </div>
        <transition name="fade">
          <div class="row" v-if="filtres">
              <div class="col-md-3">
                  <div class="form-group">
                      <label>Colección</label>
                      <select class="form-control" v-model="id_collections">
                        <option v-for="collection in collections" :value="collection.id">{{ collection.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label>Categoría</label>
                      <select class="form-control" v-model="id_categories">
                          <option v-for="categorie in categories" :value="categorie.id">{{ categorie.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label>Colores</label>
                      <select class="form-control" v-model="id_colors">
                        <option v-for="color in colors" :value="color.id">{{ color.name }}</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label></label>

                      <button class="btn btn-info" style="margin: 29px;" @click="FiltersProducts()">BUSCAR</button>
                  </div>
              </div>
          </div>
        </transition>
        <br>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div class="btn-toolbar">
              <router-link to="/products/create">
                <button class="btn btn-info" style="margin  : 7px;">
                  <feather type="plus"/> Nuevo Producto
                </button>
              </router-link>
              
              <a href="/generateQR/product" target="_blank">
                <button class="btn btn-info" style="margin  : 7px;">
                    Generar QR <i class="fa fa-qr"></i>
                </button>
              </a> 
              
            </div>
          </div>
        </div>
        <hr>
        <div class="card-body row">
            <div class="card card col-4" v-for="item in products" :key='item.id'>              
              <toggle-button style=" position: absolute; right: 10%; top: 5%;" :value="!disableds.find(e => e.product_id == item.id)" @change="disableProduct(item, $event.target.value)"></toggle-button>
              <img class="card-img-top" :src="'/api/products/'+item.image_url" alt="Card image cap">
              <div class="card-body">
                <h4 class="card-title" style="font-weight:bolder">
                  {{ item.name }}
                </h4>
                <!--<div class="row">
                  <div class="col-2">
                    <div class="form-group">
                        <label>Color</label>
                        <div class="color-button" v-bind:style="{ 'background-color': item.color.hex}"></div>
                    </div>                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-10">
                    <h5>Talla - 36 </h5>
                  </div>
                </div>-->
                <h5 class="card-title">{{ item.category.name }}</h5>
                <h4 class="card-title">S/{{ item.sale_price.toFixed(2) }}</h4> 
                <h5> <b>Descuento :</b>  {{ item.discount ? result_desc=parseFloat(item.sale_price - (item.discount.porcentage*item.sale_price)/100).toFixed(2) : 'No tiene Descuento'  }} </h5>
                <div class="col-12">
                  <router-link :to="{ path: `/products/${item.id}/edit` }" class="mr-2">
                    <button class="btn btn-secondary btn-sm">Editar</button>
                  </router-link>
                  <button class="btn btn-secondary btn-sm">
                    <a @click.prevent="deleteProduct(item.id)">Eliminar</a>
                  </button>
                  <button class="btn btn-secondary btn-sm">
                    <a @click="Modal(item.id)">Agregar Descuento</a>
                  </button>
                </div>                  
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
    this.Categories();
    this.Collections();
    this.Colors();    
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
      filtres:false,
      id_categories:'',
      id_collections:'',
      id_colors:'',
      categories:[],
      collections:[],
      colors:[],
    }
  },
  methods: {

    Modal(id){
      console.log(id);
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
          this.fetchData();
          //this.$router.replace('/deliveries')
        }).catch(err => {
          console.log(err.response);
        });
    },  

    Filtres(){
        this.filtres = 1;
    },

    Categories(){
        axios.get('categories').then(res => {
          this.categories = res.data.categories;
        });
    },

    Collections(){
        axios.get('collections').then(res => {
          this.collections = res.data.collections;
        });
    },

    Colors(){
        axios.get('colors').then(res => {
          this.colors = res.data.colors;
        });
    },

    FiltersProducts(){
        var params = {
            page: this.page, 
            id_categories: this.id_categories , 
            id_collections : this.id_collections , 
            id_colors : this.id_colors,
        };
        axios.post('filters_products',{params}).then(res => {
          console.log(res);
          this.products = res.data.products;
          this.pages = res.data.pages;
          this.count = res.data.count;
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
      axios.post(`products/search`,{
        'key': this.key
      }).then(res => {
        console.log(res);
        this.products = res.data.products;
      }).catch(err => {
        console.log(err.response);
        this.$snotify.error(err.response.data);
      });
      //this.key = '';
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
      axios.get('products/all', { params }).then(res => {
        //console.log(res.data.pages);
        this.products = res.data.products;
        this.pages = res.data.pages;
        this.count = res.data.count;
        console.log(this.products);
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
        background: white;
        border-radius: 3px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        margin-top: 50px;
        opacity: 0;
        padding: 4px;
        transform: scale(1);
        transition: all .40s cubic-bezier(0.39, 0.575, 0.565, 1);
        visibility: hidden;
    }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }
</style>