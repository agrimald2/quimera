<template>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">Tallas</h3>
            <div class="btn-toolbar">
              <router-link class="btn btn-info" to="/sizes/create">
                <feather type="plus"/>
                Nuevo
              </router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <caption>
              <page-navigation v-model="page" :pages="pages" :count="count" :items="sizes.length" @confirm="fetchData"/>
            </caption>
            <thead>
              <th>Nombre</th>
              <th>Opciones</th>
              <!-- <th>Sub Categoria</th> -->
              <!-- <th>P. de Venta</th> -->
            </thead>
            <tbody>
              <tr v-for="item in sizes" :key='item.id'>
                <td>{{ item.name }}</td>
                <td>
                  <router-link :to="{ path: `/sizes/${item.id}/edit` }">
                    <feather type="edit"/>
                  </router-link>
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
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      sizes: [],
      page: 1,
      pages: null,
      count: null,
    }
  },
  methods: {
    fetchData() {
      var params = { page: this.page };
      axios.get('sizes', { params }).then(res => {
        console.log(res.data);
        this.sizes = res.data.sizes;
        this.pages = res.data.pages;
        this.count = res.data.count;
      }).catch(res => {
        console.log(res);
      });
    }
  }
}
</script>

<style>

</style>