<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Nueva Coleccion</h3>
        </div>
        <div class="card-body">
          <div class="row form-group">
            <div class="col">
              <label for="">Nombre</label>
              <input type="text" v-model="collection.name" class="form-control" placeholder="Nombre" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Fecha de Inicio de temporada</label>
              <input type="date" v-model="collection.date_start" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Fecha fin de temporada</label>
              <input type="date" v-model="collection.date_end" class="form-control">
            </div>
          </div>
          <div class="col">
            <div class="card">
              <input id="inputFile" @change="setImage($event.target.files[0])" type="file" hidden>
              <div class="card-header">
                <h3>Imagen de la Colección</h3>
              </div>
              <label for="inputFile" class="card-body text-white text-center border" style="cursor:pointer">
                <feather class="feather-xxl" type="image" v-if='!src'/>
                <img id="priviewImage" class="img-fluid" :src="src" alt="imagen" v-else>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <router-link :to="{path:'/collections'}">
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
import Compressor from 'compressorjs'
export default {
  data() {
    return {
      collection: {},
      srcTmp: null,
      file: null,
    }
  },
  methods: {
    async submit() {
      if (!this.file) {
        return this.$snotify.error('Es necesario una imagen');
      }

      var image = await new Promise((resolve, reject) => {
        new Compressor(this.file, {
          quality: 0.2,
          success: async (result) => {
            const formData = new FormData();
            resolve(result);
          }
        });
      });
      var formData = new FormData();
      formData.append('image', image);
      var config = {
          headers: {
              'content-type': 'multipart/form-data'
          }
      }
      var path = await axios.post('collections/image', formData, config).then(res => res.data);
      this.collection.image_url = path;
      axios.post('collections', { collection: this.collection }).then(res => {
        console.log(res.data);
        this.$snotify.success('Colección registrada correctamente');
        this.$router.replace('/collections')
      }).catch(err => {
        console.log(err.response);
      });
    },
    setImage(file) {
      this.file = file;
      // console.log(file);
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        // console.log(reader.result);
        this.srcTmp = reader.result;
      };
    },
  },
  computed: {
    src() {
      if (this.srcTmp) {
        return this.srcTmp;
      } else {
        return null;
      }
    }
  }
}
</script>

<style>

</style>