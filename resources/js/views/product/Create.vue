<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Nuevo Producto</h3>
        </div>
        <div class="card-body">
          <div class="row form-group">
            <div class="col">
              <label for="">Nombre</label>
              <input type="text" v-model="product.name" class="form-control" placeholder="Nombre" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col">
              <label for="">Colección</label>
              <select class="custom-select text-uppercase" v-model="product.collection_id">
                <option :value="null" disabled selected>COLECCIÓN</option>
                <option v-for="item in collections" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <div class="col">
              <label for="">Marca</label>
              <select class="custom-select text-uppercase" v-model="product.brand_id">
                <option :value="null" disabled selected>MARCA</option>
                <option v-for="item in brands" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col">
              <label for="">Categoria</label>
              <select class="custom-select text-uppercase" v-model="product.category_id" required>
                <option :value="null" disabled selected>CATEGORIA</option>
                <option v-for="item in categories" :value="item.id" :key="item.id">{{ item.name }}</option>
              </select>
            </div>            
            <div class="col">
              <label for="">Color</label>
              <select class="custom-select text-uppercase" v-model="product.color_id">
                <option :value="null" disabled selected>COLOR</option>
                <option v-for="item in colors" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <div class="col">
              <label for="">Talla</label>
              <select class="custom-select text-uppercase" v-model="product.size_id">
                <option :value="null" disabled selected>TALLA</option>
                <option v-for="item in sizes" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Unidad</label>
              <select class="custom-select text-uppercase" v-model="product.unit_code" required>
                <!-- <option :value="null" disabled selected>SELECCIONE UNA SUB CATEGORIA</option> -->
                <option v-for="(item, index) in unitCodes" :key="index" :value="item.unitCode">{{ item.name }}</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">PRECIO</label>
              <input type="number" v-model.number="product.sale_price" step="any" min="0" class="form-control" placeholder="S/." required>
            </div>
            <div class="col">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="product.new_product" id="checkProduct">
                <label class="form-check-label" for="checkProduct">
                  Producto Nuevo
                </label>
              </div>
            </div>            
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Descripcion</label>
              <textarea rows="2" v-model="product.description" class="form-control" placeholder="Descripcion (Opcional)"></textarea>
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
  </form>
</template>

<script>
import Compressor from 'compressorjs'

export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      resource: 'products',
      categories: [],
      collections: [],
      brands: [],
      subCategories: [],
      sizes: null,
      srcTmp: null,
      file: null,
      colors: null,
      product: {
        unit_code: 'NIU',
        category_id: null,
        color_id: null,
        collection_id: null,
        brand_id: null,
        size_id: null
      },
    }
  },
  computed: {
    src() {
      if (this.product.image_url) {
        return `/api/products/${this.product.image_url}`;
      } else if (this.srcTmp) {
        return this.srcTmp;
      } else {
        return null;
      }
    }
  },
  methods: {
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
    fetchData() {
      axios.get(`${this.resource}/tables`).then(res => {
        this.categories = res.data.categories;
        this.collections = res.data.collections;
        this.brands = res.data.brands;
        this.colors = res.data.colors;
        this.sizes = res.data.sizes;        
      });
    },
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
            // formData.append('file', result, result.name);
            // await this.$http.post('uploadsPhotos', formData).then(res => {
            //   var file = res.body.file;
            //   this.pictures.push(file)
            // });
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
      var path = await axios.post('products/image', formData, config).then(res => res.data);
      this.product.image_url = path;
      axios.post('products', { product: this.product }).then(res => {
        console.log(res.data);
        this.$snotify.success('Producto registrado correctamente');
        this.$router.replace('/products')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>