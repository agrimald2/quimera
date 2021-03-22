<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar Color</h3>
        </div>
        <div class="card-body">
          <div class="row form-group">
            <div class="col">
              <label for="">Nombre</label>
              <input type="text" v-model="color.name" class="form-control" placeholder="Nombre" required>
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
      color: {},
    }
  },
  methods: {
    fetchData() {
      var colorId = this.$route.params.colorId;
      axios.get(`colors/${colorId}`).then(res => {
        console.log(res);
        this.color = res.data.color;
      });
    },
    submit() {
      axios.put(`colors/${this.color.id}`, { color: this.color }).then(res => {
        console.log(res.data);
        this.$snotify.success('Se han guardado los cambios');
        // this.$router.replace('/colors')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>