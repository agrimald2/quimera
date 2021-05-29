<template>
<div class="row">
  <pos-modal @confirm="submit"/>
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
    <div class="form-row">
      <div class="col">
        <div class="card">
          <div class="card-header py-2">
            <div class="d-flex justify-content-between">
              <h3 class="card-title mb-0">Punto de Venta</h3>
              <div class="btn-toolbar">
                <button type="button" data-toggle="modal" data-target="#posModal" class="btn btn-info" to="/deliveries/create"  style="margin: 7px;">
                  <feather type="save"/>
                  Guardar
                </button>
                <button class="btn btn-info" @click="QRVue" style="margin: 7px;">
                    Escaner QR <i class="fa fa-qr"></i>
                </button>
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action" v-for="(item, productIndex) in products" :key="item.id">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="lead">{{ item.name }}</span>
                  <br>
                  <span>{{ item.category.name }}</span>
                  <br>
                </div>
                <div class="align-items-center">
                  <span class="mr-2">{{ item.counter }} UNI - Disponible: {{ checkInventory(item).map(e => e.weight).reduce((a, b) => a + b, 0).toFixed(0) }}UNI - Total: S/ {{ (checkInventory(item).map(e => e.weight).reduce((a, b) => a + b, 0) * item.sale_price).toFixed(2) }}</span>
                  <br>
                  <div class="btn-group float-right">
                    <button type="button" class="btn btn-secondary" data-toggle="collapse" :data-target="`#inventoryCollapse${productIndex}`">
                      <feather type="chevron-down"/>
                    </button>
                    <button type="button" @click="removeProduct(item)" class="btn btn-secondary">
                      <feather type="trash-2"/>
                    </button>
                    <button type="button" @click="minusProduct(item)" class="btn btn-info">
                      <feather type="minus"/>
                    </button>
                    <button type="button" @click="plusProduct(item)" class="btn btn-info">
                      <feather type="plus"/>
                    </button>
                  </div>
                </div>
              </div>
              <div class="collapse pt-3" :id="`inventoryCollapse${productIndex}`">
                <strong>Para buscar un código específico presiona CTRL + F</strong>
                <table class="table w-100">
                  <thead>
                    <th>Codigo</th>
                    <th>F. Ingreso</th>
                    <th>Incluido</th>
                  </thead>
                  <tbody>
                    <tr v-for="inventory in item.inventory" :key="inventory.id">
                      <td>{{ inventory.codigo }}</td>
                      <!--<td>{{ inventory.weight.toFixed(3) }}</td>-->
                      <td>{{ formatDate(inventory.created_at) }}</td>
                      <td>
                        <toggle-button :value='item.picked.includes(e => e == e.id == inventory.id)' @change="pick(item, inventory)"></toggle-button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </a>
          </ul>
        </div>
      </div>
      <div class="col-md-4" v-if="productsPane.length">
        <div class="card">
          <div class="card-header py-2">
            <div class="d-flex justify-content-between">
              <h3 class="card-title mb-0">Resultados</h3>
              <div class="btn-toolbar">
              </div>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action" @click.prevent="addProduct(item)" v-for="item in productsPane" :key="item.id">
              <div class="row">
                <div class="col-6">
                  <img class="card-img-top" :src="'/api/products/'+item.image_url" alt="Card image cap">
                </div>
                <div class="col-6">
                  <span class="lead"><h2>{{ item.name }}</h2></span>
                  <span>
                    <h3>{{ item.category.name }}</h3>
                  </span>
                  <div class="row">
                    <div class="col-2">
                      <div class="color-button" v-bind:style="{ 'background-color': item.color.hex}"></div>
                    </div>
                    <div class="col-10">
                      <h4>Talla: {{ item.size_id }}</h4>
                    </div>
                  </div>
                  <span>
                    <h3>S/{{item.sale_price.toFixed(2)}}</h3>
                  </span>                  
                </div>
              </div>
            </a>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import PosModal from '@/components/PosAdminModal'
import { mapGetters, mapActions } from 'vuex'
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader';

export default {
  components: {
    PosModal,
    QrcodeStream,
    QrcodeDropZone,
    QrcodeCapture
  },
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      key: '',
      qr_vue:0,
      deliveries: [],
      productsPane: []
    }
  },
  computed: {
    ...mapGetters({
      products: 'sale/products',
    }),
  },
  methods: {
    ...mapActions({
      addProduct: 'sale/addProduct',
      plusProduct: 'sale/plusProduct',
      removeProduct: 'sale/removeProduct',
      removeAllProducts: 'sale/removeAllProducts',
      minusProduct: 'sale/minusProduct',
    }),
    QRVue(){
        this.qr_vue=1;
    },

    Cerrar(){
        this.qr_vue=0;
    },
    onDecode(decodedString){
        var product_name = decodedString;
        console.log(product_name);

        axios.get('products/'+product_name+'/search').then(res => {
          console.log(res);
          this.productsPane = res.data.products;
          this.Cerrar();
        }).catch(err => {
          console.log(err.response);
          this.$snotify.error(err.response.data);
        });
        this.key = '';
    },
    pick(product, inventory) {
      const index = product.picked.findIndex(e => e.id == inventory.id);
      console.log("index =>",index);
      if (index >= 0) {
        product.picked.splice(index, 1);
      } else {
        product.picked.push(inventory);
      }
    },
    submit(sale) {
      var inventories = [];
      this.products.forEach(item => {
        inventories.push(...this.checkInventory(item));
      });
      if (inventories.length) {
        sale.channel = 'PUNTO DE VENTA';
        axios.post('sales', { sale, inventories, email: sale.email, processPayment: sale.processPayment }).then(res => {
          console.log(res);
          this.$loading(false);
          this.$snotify.success('Venta registrada correctamente');
          this.productsPane = [];
          this.removeAllProducts();
        }).catch(error => {
          this.productsPane = [];
          console.log(error.response);
        });
      } else {
        this.$loading(false);
        this.$snotify.error('Es necesario al menos un producto');
      }
    },
    searchProducts() {
      axios.get(`products/${this.key}/search`).then(res => {
        console.log(res);
        this.productsPane = res.data.products;
      }).catch(err => {
        console.log(err.response);
        this.$snotify.error(err.response.data);
      });
      this.key = '';
    },
    fetchData() {
      this.productsPane = [];
      // this.products = [];
      this.removeAllProducts();
      axios.get('deliveries').then(res => {
        console.log(res.data);
        this.deliveries = res.data.deliveries;
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style scoped>
  .color-button{
    height: 20px;
    width: 20px;
  }
    .list-group-item-action:hover, .list-group-item-action:focus {
      background-color: unset;
      color: white;
    }

    .search-input input {
      padding-right: 2rem;
      padding-left: 2rem;
      height: 4rem;
      border: none;
      font-size: 17px;
      font-weight: 100;
    }

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