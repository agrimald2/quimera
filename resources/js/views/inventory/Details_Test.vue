<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detalles de Inventario</h3><button @click="$router.go(-1)" type="button" class="btn btn-info mr-2">Atrás</button>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <th>Materia prima</th>
              <th>Total</th>
              <th>Codigo</th>
              <th>Vendido</th>
              <th>Entrega</th>
              <th>F. Ingreso</th>
              <th></th>
            </thead>
            <tbody>
              <tr v-for='(item, index) in product.inventory_all' :key="index">
                <td>{{ item.raw_material_id ? item.raw_material_id : 'NO' }} </td>
                <td>{{ item.weight.toFixed(3) }}</td>
                <td>{{ item.codigo }}</td>
                <td v-if="item.sale_id">Si</td>
                <td v-else>No</td>
                <td v-if="item.delivered_date">Si</td>
                <td v-else>No</td>
                <td>{{ formatDate(item.created_at) }}</td>
                <td>
                  <div class="btn-toolbar">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <feather type="more-vertical"/>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="#" class="dropdown-item" data-toggle="modal" data-target="#moveModal" @click="inventory = item">Mover de Sucursal</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
            <span></span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Categoria:</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total:</span>
            <span>{{ product.inventory.map(e => e.weight).reduce((a, b) => a + b, 0).toFixed(3) }} UNI</span>
          </li>
        </ul>
      </div>
    </div>
  </form>
</template>

<script>

export default {


  mounted() {
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
    fetchData() {
      var code_inventorie = this.$route.params.code_inventorie;
      var url = `/generateQR/inventories/${code_inventorie}`;
      var params = this.$route.query.raw_material;
      if(params){
        url+=`?rm=${params}`
      }
      axios.get(url).then(res => {
        console.log(res.data);
        this.product = res.data;
        if(params){
          this.product.inventory_all = this.product.inventory_rm
        }
      }).catch(err => {
        console.log(err.response);
      });
    }
  }

}
</script>

<style>

</style>