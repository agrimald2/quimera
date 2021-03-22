<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar Marca</h3>
        </div>
        <div class="card-body">
          <div class="row form-group">
            <div class="col">
              <label for="">Nombre</label>
              <input type="text" v-model="brand.name" class="form-control" placeholder="Nombre" required>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-info float-right">
                <feather type="save"/>
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- <div class="card">
        <div class="card-header">
          <h3>Imagen del Producto</h3>
        </div>
        <div class="card-body">

        </div>
      </div> -->
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
      brand: {},
    }
  },
  methods: {
    fetchData() {
      var brandId = this.$route.params.brandId;
      axios.get(`brands/${brandId}`).then(res => {
        console.log(res);
        this.brand = res.data.brand;
      });
    },
    submit() {
      axios.put(`brands/${this.brand.id}`, { brand: this.brand }).then(res => {
        console.log(res.data);
        this.$snotify.success('Se han guardado los cambios');
        // this.$router.replace('/brands')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>