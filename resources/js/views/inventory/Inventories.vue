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
      <div class="form-group">
        <form @submit.prevent="searchProducts" class="search-input">
          <input type="text" v-model="key" class="form-control" placeholder="BUSCADOR" required>
        </form>
      </div>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">Inventario</h3>
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
        <div class="card-body">
          <table class="table">
            <caption>
              <page-navigation v-model="page" :pages="pages" :count="count" :items="products.length" @confirm="fetchData"/>
            </caption>
            <thead>
              <th>Nombre</th>
              <th>Paquetes</th>
              <th>T. Kilos</th>
              <th>Opciones</th>
            </thead>
            <tbody>
              <tr v-for="item in products" :key='item.id'>
                <td>{{ item.name }} {{ item.category.name }}</td>
                <td>{{ item.packages }} Pak</td>
                <td>{{ item.weights.toFixed(3) }} Kg</td>
                <td>
                  <div class="btn-toolbar">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <feather type="more-vertical"/>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <router-link :to="{ path: `/inventories/${item.id}/create` }" class="dropdown-item">Ingresar Paketes</router-link>
                      <router-link :to="{ path: `/inventories/${item.id}/details` }" class="dropdown-item">Ver Paketes</router-link>
                      <!-- <button class="dropdown-item" type="button">Another action</button> -->
                      <!-- <button class="dropdown-item" type="button">Retirar</button> -->
                    </div>
                  </div>
                </td>
                <!-- <td>{{ item.category }}</td>
                <td>{{ item.sub_category }}</td>
                <td>{{ item.sale_price }}</td> -->
              </tr>
            </tbody>
          </table>
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
  },
  data() {
    return {
      products: [],
      page: 1,
      pages: null,
      count: null,
      key: null,
      qr_vue:0,
    }
  },
  methods: {
    QRVue(){
        this.qr_vue=1;
    },

    Cerrar(){
        this.qr_vue=0;
    },
    onDecode(decodedString){
        var id = decodedString;
        console.log(id);
        window.location.href='/inventories/'+id+'/create';
        /*var separar1 = url.split('https://www.karpawasi.com/');       
        var separar = separar1[1].split('#/');
        window.location.href = separar[0];*/
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
          'T. DE KILOS',
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
</style>