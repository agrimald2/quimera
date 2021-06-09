<template>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <form @submit.prevent="searchProducts" class="search-input">
          <input type="text" v-model="key" class="form-control" placeholder="BUSCADOR" required>
        </form>
      </div>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">Clientes</h3>
            <div class="btn-toolbar">
              <!-- <router-link class="btn btn-info" to="/customers/create">
                <feather type="plus"/>
                Nuevo
              </router-link> -->
            </div>
          </div>
        </div>
        <div class="card-body" style="color: white">
          <div class="row">
            <div class="col-12 col-md-6 row client_info" v-for="item in customers" :key='item.id' data-toggle="dropdown">
              <div class="row">
                <div class="col-12 col-md-8">
                  {{item.name}}
                </div>
                <div class="col-6 col-md-4">
                  23 Compras
                </div>
                <div class="col-6 col-md-4" style="z-index: 200;">
                  <a :href="'https://wa.me/51' + item.mobile" target="_blank"> 
                    {{item.mobile}}
                  </a>
                </div>
              </div>
              <div class="dropdown-menu row" style="color:black">
                   <div class="col-6">
                      <router-link :to="{ path: `/customers/${item.id}/edit` }" style="color:black">
                        <feather type="edit"/>
                      </router-link>   
                   </div>
                    <div class="col-6">
                      <router-link :to="{ path: `/customers/${item.id}/details` }" style="color:black">
                        <feather type="menu"/>
                      </router-link> 
                   </div>
              </div>
            </div>
          </div>
          <caption>
            <page-navigation v-model="page" :pages="pages" :count="count" :items="customers.length" @confirm="fetchData"/>
          </caption>
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
      customers: [],
      page: 1,
      pages: null,
      count: null,
    }
  },
  methods: {
    fetchData() {
      var params = { page: this.page };
      axios.get('customers', { params }).then(res => {
        console.log(res.data);
        this.customers = res.data.customers;
        this.pages = res.data.pages;
        this.count = res.data.count;
      }).catch(err => {
        console.log(err.response);
      });
    },
    searchProducts() {
      axios.get(`customers/${this.key}/search`).then(res => {        
        this.customers = res.data.customers;
      }).catch(err => {
        console.log(err.response);
        this.$snotify.error(err.response.data);
      });
      this.key = '';
    }
  }
}
</script>

<style scoped>
  .row{
    margin: 0;
  }
  .client_info{
    margin-top: 15px;
    padding: 2px;
  }
  .client_info .row{
    border: 1px solid white;
    padding: 2px;
    border-radius: 5px;
  }
  .show{
    display: flex;
    margin-bottom: 15px;
    margin-left: 3px;
  }
</style>