<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar Coleccion</h3>
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
                <h3>Imagen del Producto</h3>
              </div>
              <label for="inputFile" class="card-body text-white text-center border" style="cursor:pointer">
                <feather class="feather-xxl" type="image" v-if='!src'/>
                <img id="priviewImage" class="img-fluid" :src="src" alt="imagen" v-else>
              </label>
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
      collection: {},
      srcTmp: null,
      file: null,
    }
  },
  methods: {
    fetchData() {
      var collectionId = this.$route.params.collectionId;
      axios.get(`collections/${collectionId}`).then(res => {
        console.log(res);
        this.collection = res.data.collection;
      });
    },
    async submit() {
      var formData = new FormData();
      if (this.file) {
        formData.append('image', this.file);
        formData.append('image_url', this.collection.image_url);
        var config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        try {
          var path = await axios.post('collections/image', formData, config).then(res => res.data);
        } catch (error) {
          console.log(error.response);        
        }
        this.collection.image_url = path;
      }
      axios.put(`collections/${this.collection.id}`, { collection: this.collection }).then(res => {
        console.log(res.data);
        this.$snotify.success('Se han guardado los cambios');
        // this.$router.replace('/collections')
      }).catch(err => {
        console.log(err.response);
      });
    },
    setImage(file) {
      this.file = file;
      console.log(file);
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.srcTmp = reader.result;
      };
    },
  },
  computed: {
    src() {
      if (this.collection.image_url && !this.srcTmp) {
        return `/api/products/${this.collection.image_url}`;
      } else if (this.srcTmp) {
        return this.srcTmp;
      } else {
        return null;
      }
    }
  },
}
</script>

<style>

</style>