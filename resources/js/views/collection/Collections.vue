<template>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <TabsVue></TabsVue>
          <div class="d-flex justify-content-between">
            <div class="card">
              <div class="card-header row">
                <div class="btn-toolbar">
                  <router-link class="btn btn-info" to="/collections/create">
                    <feather type="plus"/>
                    Crear Nueva Colección
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <caption>
              <page-navigation v-model="page" :pages="pages" :count="count" :items="collections.length" @confirm="fetchData"/>
            </caption>
            <thead>
              <th>Nombre</th>
              <th>Opciones</th>
              <!-- <th>Sub Categoria</th> -->
              <!-- <th>P. de Venta</th> -->
            </thead>
            <tbody>
              <tr v-for="item in collections" :key='item.id'>
                <td>{{ item.name }}</td>
                <td>
                  <router-link :to="{ path: `/collections/${item.id}/edit` }">
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
<style scoped>
.nav-link  .active{
    color: #eceef0 !important;
  }
</style>
<script>
import TabsVue from "../widgets/Tabs";

export default {
  components:{
      TabsVue
  },
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      collections: [],
      page: 1,
      pages: null,
      count: null,
    }
  },
  methods: {
    fetchData() {
      var params = { page: this.page };
      axios.get('collections', { params }).then(res => {
        console.log(res.data);
        this.collections = res.data.collections;
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