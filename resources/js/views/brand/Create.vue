<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Nueva Marca</h3>
        </div>
        <div class="card-body">
          <div class="row form-group">
            <div class="col">
              <label for="">Nombre</label>
              <input type="text" v-model="brand.name" class="form-control" placeholder="Nombre" required>
            </div>
          </div>
          <!-- <div class="row form-group">
            <div class="col">
              <label for="">Categoria</label>
              <select class="custom-select" v-model="product.brand" required>
                <option :value="null" disabled selected>SELECCIONE UNA CATEGORIA</option>
                <option value="1">OPCION</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Sub Categoria</label>
              <select class="custom-select" v-model="product.sub_brand" required>
                <option :value="null" disabled selected>SELECCIONE UNA SUB CATEGORIA</option>
                <option value="1">OPCION</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Precio de Venta (Incluir IGV)</label>
              <input type="number" v-model.number="product.sale_price" step="any" class="form-control" placeholder="Precio de Venta (Incluir IGV)" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Descripcion</label>
              <textarea rows="2" v-model="product.description" class="form-control" placeholder="Descripcion (Opcional)"></textarea>
            </div>
          </div> -->
          <div class="row">
            <div class="col">
              <router-link :to="{path:'/brands'}">
                  <button class="btn btn-primary">
                    Cancelar
                  </button>
              </router-link>
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
  data() {
    return {
      brand: {},
    }
  },
  methods: {
    submit() {
      axios.post('brands', { brand: this.brand }).then(res => {
        console.log(res.data);
        this.$snotify.success('Marca registrada correctamente');
        this.$router.replace('/brands')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>