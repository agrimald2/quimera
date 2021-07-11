<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ingreso de Inventario</h3>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <button type="button" class="btn btn-info btn-block" @click="addInventory">
              <feather type="plus"/>
              Agregar 
            </button>
          </li>
          <li class="list-group-item d-flex justify-content-between" v-for="(item, index) in inventories" :key="index">
            <div class="input-group mr-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  UNI
                </div>
              </div>
              <input type="number" v-model="item.weight" class="form-control" min="0" step="any" placeholder="UNI" required>
            </div>
            <div class="input-group mr-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  Cantidad
                </div>
              </div>
              <input type="number" v-model="item.quantity" class="form-control" placeholder="Cantidad" min="1" required>
            </div>
            <div class="input-group mr-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  Color
                </div>
              </div>
              <select class="custom-select text-uppercase" v-model="item.color_id">
                <option :value="null" disabled selected>COLOR</option>
                <option v-for="item in colors" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <div class="input-group mr-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  Talla
                </div>
              </div>
              <select class="custom-select text-uppercase" v-model="item.size_id">
                <option :value="null" disabled selected>TALLA</option>
                <option v-for="item in sizes" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <button type="button" class="btn btn-secondary" @click="inventories.splice(index, 1)">
              <feather type="trash-2"/>
            </button>
          </li>
          <li class="list-group-item">
            <button type="submit" class="btn btn-info float-right">
              <feather type="save"/>
              Guardar
            </button>
          </li>
        </ul>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3>Datos del Producto</h3>
        </div>
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
            <span>Total:</span>
            <span>{{ inventories.map(e => e.weight * e.quantity).reduce((a, b) => a + b, 0) }} UNI</span>
          </li>
        </ul>
        <!-- <div class="card-body">
          
        </div> -->
      </div>
    </div>
  </form>
</template>

<script>
export default {
  mounted() {
    this.inventories.push(Object.assign({}, this.inventory));
    this.fetchData();
    this.ColorsData();
    this.SizeData();
  },
  data() {
    return {
      product: {
        category: {},
        sub_category: {},
      },
      inventory: {
        weight: null,
        quantity: 1,
      },
      inventories: [],
      sizes:[],
      colors:[],      
    }
  },
  methods: {
    addInventory() {
      console.log('chulapi');
      this.inventories.push(Object.assign({}, this.inventory));
    },
    fetchData() {
      var productId = this.$route.params.productId;
      axios.get(`products/${productId}`).then(res => {
        console.log(res);
        this.product = res.data.product;
      }).catch(err => {
        console.log(err.response);
      });
    },
    ColorsData() {
      axios.get('colors').then(res => {
        console.log(res);
        this.colors = res.data.colors;
      }).catch(err => {
        console.log(err.response);
      });
    },
    SizeData() {
      axios.get('sizes').then(res => {
        console.log(res);
        this.sizes = res.data.sizes;
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
      axios.post('inventories', { inventories: this.inventories, product_id: this.product.id }).then(res => {
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

<style>

</style>