<template>
  <form @submit.prevent="submit" class="row">
    <move-modal :inventory="inventory" @confirm="fetchData"></move-modal>
    <div class="col-6">
      <div class="card">
        <div class="card-header row">
          <div class="col-6">
              <h3>Datos del Producto </h3> 
          </div>
          <div class="col-4">
            <router-link to="/inventories">
                <button class="btn btn-info">Volver</button>
            </router-link>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
                <img class="card-img-top" :src="'/api/products/'+product.image_url" alt="Card image cap" style="padding:1vw">
          </div>
          <div class="col-6">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between">
                <span>Nombre:</span>
                <span>{{ product.name }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Categoria:</span>
                <span>{{ product.category.name }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>S/:</span>
                <span>{{ product.sale_price }}</span>
              </li>              
              <li class="list-group-item d-flex justify-content-between">
                <span>Total:</span>
                <span>{{ product.inventory.map(e => e.weight).reduce((a, b) => a + b, 0) }} UNI</span>
              </li>
            </ul>            
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header row">
          <div class="col-6">
              <h3 class="card-title">Detalles de Inventario</h3>
          </div>
          <div class="col-3">
              <input type="text" class="form-control" placeholder="Digite codigo de inventario">
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <th>Codigo</th>
              <th>Vendido</th>
              <th>Entrega</th>
              <th>F. Ingreso</th>
              <th>Color</th>
              <th>Talla</th>
              <th>Gen. QR</th>
              <th>Acción</th>
            </thead>
            <tbody>
              <tr v-for='(item, index) in product.inventory_all' :key="index">
                <td>{{ item.codigo }}</td>
                <td v-if="item.sale_id">Si</td>
                <td v-else>No</td>
                <td v-if="item.delivered_date">Si</td>
                <td v-else>No</td>
                <td>{{ formatDate(item.created_at) }}</td>
                <td> <div :style="'background:'+product.color.hex+';width: 30px;height: 30px;'"></div> </td>
                <td>{{ product.size.name }}</td>
                <td><a :href="'/generateqr_product/'+item.codigo" target="_blank">Generar QR</a> </td>
                <td>
                  <button data-toggle="dropdown" class="btn btn-primary"> Ver
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#moveModal" @click="inventory = item">Mover de Sucursal</a>
                        <a href='#'  class="dropdown-item" @click.prevent='deleteInventory(item)'>Eliminar</a>                    
                      </div>
                  </button>
                </td>                  
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </form>
</template>
<style scoped>
tr {
  color: whitesmoke;
}
</style>

<script>
import MoveModal from '@/components/MoveModal'

export default {
  components: {
    MoveModal
  },
  mounted() {
    this.inventories.push(Object.assign({}, this.inventory));
    this.fetchData();
  },
  data() {
    return {
      product: {
        category: {},
        sub_category: {},
        inventory: [],
      },
      inventory: {
        weight: null,
        quantity: 1
      },
      inventories: [],
    }
  },
  methods: {
    addInventory() {
      this.inventories.push(Object.assign({}, this.inventory));
    },
    deleteInventory(inventory) {
      let ok = confirm('Esta seguro de eliminar?...');
      if (ok) {
        axios.delete(`inventories/${inventory.id}`).then(res => {
          console.log(res);
          this.fetchData();
        });
      }
    },
    fetchData() {
      var productId = this.$route.params.productId;
      var url = `products/${productId}/inventoryAll`;
      var params = this.$route.query.raw_material;
      if(params){
        url+=`?rm=${params}`
      }
      axios.get(url).then(res => {
        console.log(res.data.product);
        this.product = res.data.product;
        if(params){
          this.product.inventory_all = this.product.inventory_rm
        }
      }).catch(err => {
        console.log(err.response);
      });
    },
    submit() {
      if (!this.inventories.length) {
        return this.$snotify.error('Es necesario al menos 1 ingreso');
      }
      this.inventories.forEach(item => {
        item.product_id = this.product.id;
      });
      axios.post('inventories', { inventories: this.inventories }).then(res => {
        console.log(res.data);
        this.$snotify.success('Inventario registrado correctamente');
        this.$router.replace('/inventories')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>
