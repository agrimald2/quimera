<template>
  <div class="row">
    <!--Modal-->
      <div  class="permiso" :class="{'mostrar' : qr_vue}" style="overflow-y: auto;padding-top: 50px;" @click="Cerrar">
          <div class="permiso-content" style="width: 304px !important;">
              <div class="modal-body">
                  <div class="row">
                      <qrcode-stream v-if="qr_vue===1" @decode="onDecode"></qrcode-stream>
                  </div>
              </div>
          </div>            
      </div>
    <!--Cerrar Modal-->
    <div class="col">
      <div class="card">
          <div class="card-header">
              <h1 style="color:white">Inventario</h1>
          </div>
      </div>
      <div class="form-group row">
        <div class="col-6">
          <form @submit.prevent="searchProducts" class="search-input">
            <input type="text" v-model="key" class="form-control" placeholder="BUSCADOR" required>
          </form>
        </div>
        <div class="col-6">
          <button type="button" @click="filtres=!filtres" class="btn btn-info">
              Filtrar Búsqueda
          </button>
        </div>
      </div>    
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
                    <label></label>
                    <button class="btn btn-info" style="margin: 29px;" @click="FiltersProducts()">BUSCAR</button>                    
                </div>
            </div>
        </div>
        <br>

        <div class="row" v-if="filtres">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Colección</label>
                    <input type="date" class="form-control" v-model="date_init" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Categoría</label>
                    <input type="date" class="form-control" v-model="date_end" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label></label>
                    <button class="btn btn-info" style="margin: 29px;" @click="downloadExcelFilter()">
                      <feather type="download"/>
                        Desc. Excel
                    </button>                    
                </div>
            </div>
        </div>  
      <br>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div class="btn-toolbar">
              <button type="button" @click="downloadExcel" class="btn btn-info mr-2" style="margin: 7px;">
                <feather type="download"/>
                Desc Excel 
              </button>
              <button class="btn btn-info" @click="QRVue" style="margin: 7px;">
                    Escaner QR <i class="fa fa-qr"></i>
              </button>
              <button class="btn btn-info" style="margin: 7px;">
                   <a href="/generateQR" target="_blank">Generar QR <i class="fa fa-qr"></i></a> 
              </button>
            </div>
          </div>
        </div>
        <div class="card-body row">
          <div class="col-md-6 col-12 row inventory-card" v-for="item in products" :key='item.id'>
            <div class="col-4">
              <img :src="'/api/products/'+item.image_url" alt="">
            </div>
            <div class="col-6">
              <h4><strong>{{ item.name }}</strong></h4>
              <h5>{{ item.category.name }}</h5>

              <h6>Restante: <strong> {{ item.packages }} paquetes </strong></h6>
              <br><br>
            </div>
            <br><br><br><br>
            <div class="col-12">
              <router-link :to="{ path: `/inventories/${item.id}/create` }">
                  <button class="btn btn-secondary btn-sm">Ingresar Paquetes</button>
              </router-link>
              <router-link :to="{ path: `/inventories/${item.id}/details` }">
                  <button class="btn btn-secondary btn-sm">Ver Paquetes</button>
              </router-link>
              <a :href="'/generateqr_pack_product/'+item.id" target="_blank">
                <button class="btn btn-secondary btn-sm"> 
                    Generar QR
                </button>
              </a>
            </div>
            <!--<div class="col-2">
              <strong>{{ item.packages }}</strong> 
              <br>
              <div class="btn-toolbar">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <feather type="more-vertical"/>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <router-link :to="{ path: `/inventories/${item.id}/create` }" class="dropdown-item">Ingresar Paketes</router-link>
                      <router-link :to="{ path: `/inventories/${item.id}/details` }" class="dropdown-item">Ver Paketes</router-link>
                      <a :href="'/generateqr_pack_product/'+item.id" target="_blank" class="dropdown-item">Generar QR <i class="fa fa-qr"></i></a> 
                      <button class="dropdown-item" type="button">Another action</button>
                      <button class="dropdown-item" type="button">Retirar</button>
                    </div>
              </div>
            </div> -->
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

<script>
import { excelUtils } from '@/mixins'
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'

export default {
  mixins: [excelUtils],
  components: {
    QrcodeStream,
    QrcodeDropZone,
    QrcodeCapture
  },
  mounted() {
    this.fetchData();
    this.Categories();
    this.Collections();
  },
  data() {
    return {
      products: [],
      page: 1,
      pages: null,
      count: null,
      key: null,
      qr_vue:0,
      delivery_price_data:'',
      filtres:false,
      id_categories:'',
      id_collections:'',
      date_init:'',
      date_end:'',
      categories:[],
      collections:[],
    }
  },
  methods: {
    QRVue(){
        this.qr_vue=1;
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

    FiltersProducts(){
        var params = {
            page: this.page, 
            id_categories: this.id_categories , 
            id_collections : this.id_collections ,
            date_init:this.date_init,
            date_end:this.date_end,
        };
        axios.post('filters_inventories',{params}).then(res => {
          console.log(res);
          this.products = res.data.products;
          this.pages = res.data.pages;
          this.count = res.data.count;
        });
    },


    Cerrar(){
        this.qr_vue=0;
    },
    onDecode(decodedString){
        var code_inventorie = decodedString;
        console.log(code_inventorie);
        this.$router.push('/inventory/Details_Test/'+code_inventorie);
    },
    fetchData() {
      var params = { page: this.page };
      axios.get('products/withInventory', { params }).then(res => {
        console.log(res);
        this.products = res.data.products;
        this.pages = res.data.pages;
        this.count = res.data.count;
      }).catch(err => {
        console.log(err.response);
      });
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
    downloadExcel() {
      axios.get('products/all').then(res => {
        var wscols = [20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20];
        var body = [];
        let products = res.data.products;
        body.push([
          'PRODUCTO',
          'PAQUETES',
          'TOTAL',
        ]);
        products.forEach(item => {
          body.push([
            item.name,
            item.packages,
            item.weights,
          ]);
        });
        var name = `Inventario`;
        this.getExcel(body, name, [], wscols);
      });
    },

    downloadExcelFilter() {
        var wscols = [20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20];
        var body = [];
        body.push([
          'PRODUCTO',
          'PAQUETES',
          'TOTAL',
        ]);
        this.products.forEach(item => {
          body.push([
            item.name,
            item.packages,
            item.weights,
          ]);
        });
        var name = `Inventario`;
        this.getExcel(body, name, [], wscols);
    },

  }
}
</script>

<style>
    .permiso.mostrar {
      background-color: rgba(0,0,0,.5);
      opacity: 1;
      visibility: visible;
    }
    .permiso {
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

    .permiso.mostrar .permiso-content {
        opacity: 1;
        transform: scale(1.1);
        visibility: visible;
    }
    .permiso .permiso-content {
        background-color: transparent !important;
        border-radius: 3px;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        margin-top: 50px;
        opacity: 0;
        padding: 4px;
        transform: scale(1);
        transition: all .40s cubic-bezier(0.39, 0.575, 0.565, 1);
        visibility: hidden;
    }

    img{
    width: 100%;
  }
  .row{
    color: white;
  }
  .inventory-card{
    margin-bottom: 1rem;
    margin-top: 1rem;
  }
  .inventory-card .col-6{
    justify-content: center;
    text-align: center;
  }
  .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }
</style>