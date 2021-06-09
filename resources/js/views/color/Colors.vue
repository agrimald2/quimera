<template>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">Colores</h3>
            <div class="btn-toolbar">
              <router-link class="btn btn-info" to="/Colors/create">
                <feather type="plus"/>
                Nuevo
              </router-link>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-4" v-for="item in colors" :key='item.id' style="margin:10px">
              <router-link :to="{ path: `/colors/${item.id}/edit` }">
                <h3 v-bind:style="{color: item.hex}">{{ item.name }} &nbsp <feather type="edit"/></h3>
              </router-link>
            </div>
          </div>
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
      colors: [],
      page: 1,
      pages: null,
      count: null,
    }
  },
  methods: {
    fetchData() {
      var params = { page: this.page };
      axios.get('colors', { params }).then(res => {
        console.log(res.data);
        this.colors = res.data.colors;
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