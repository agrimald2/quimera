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
              <input type="text" v-model="name" class="form-control" placeholder="Nombre" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col">
              <label for="">Colección</label>
              <select class="custom-select text-uppercase" v-model="collection_id">
                <option :value="null" disabled selected>COLECCIÓN</option>
                <option v-for="item in collections" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <div class="col">
              <label for="">Marca</label>
              <select class="custom-select text-uppercase" v-model="brand_id">
                <option :value="null" disabled selected>MARCA</option>
                <option v-for="item in brands" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
          </div>

         <div class="row form-group">
            <div class="col">
              <label for="">Categoria</label>
              <select class="custom-select text-uppercase" v-model="category_id" required>
                <option :value="null" disabled selected>CATEGORIA</option>
                <option v-for="item in categories" :value="item.id" :key="item.id">{{ item.name }}</option>
              </select>
            </div>
          <!--             
            <div class="col">
              <label for="">Color</label>
              <select class="custom-select text-uppercase" v-model="color_id">
                <option :value="null" disabled selected>COLOR</option>
                <option v-for="item in colors" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div>
            <div class="col">
              <label for="">Talla</label>
              <select class="custom-select text-uppercase" v-model="size_id">
                <option :value="null" disabled selected>TALLA</option>
                <option v-for="item in sizes" :key="item.id" :value="item.id">{{ item.name }}</option>
              </select>
            </div> -->
          </div> 

          <div class="row form-group">
            <div class="col">
              <label for="">Unidad</label>
              <select class="custom-select text-uppercase" v-model="unit_code" required>
                <!-- <option :value="null" disabled selected>SELECCIONE UNA SUB CATEGORIA</option> -->
                <option v-for="(item, index) in unitCodes" :key="index" :value="item.unitCode">{{ item.name }}</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">PRECIO</label>
              <input type="number" v-model.number="sale_price" step="any" min="0" class="form-control" placeholder="S/." required>
            </div>
            <div class="col">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" v-model="new_product" id="checkProduct">
                <label class="form-check-label" for="checkProduct">
                  Producto Nuevo
                </label>
              </div>
            </div>            
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Descripcion</label>
              <textarea rows="2" v-model="description" class="form-control" placeholder="Descripcion (Opcional)"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Materiales</label>
              <textarea rows="2" v-model="description" class="form-control" placeholder="Materiales (Opcional)"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Envios</label>
              <textarea rows="2" v-model="description" class="form-control" placeholder="Envios (Opcional)"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col">
              <label for="">Cambios y Devoluciones</label>
              <textarea rows="2" v-model="description" class="form-control" placeholder="Cambios y Devoluciones (Opcional)"></textarea>
            </div>
          </div>  
          <div class="row form-group">
            <div class="col">
              <label for="">Limpieza y cuidados</label>
              <textarea rows="2" v-model="description" class="form-control" placeholder="Limpieza y cuidados (Opcional)"></textarea>
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
        <vue2Dropzone ref="image_url" id="dropzone"
                       v-on:vdropzone-max-files-exceeded="maxFilesAlert"
                       :options="dropzoneOptions">
        </vue2Dropzone>


        <!--  <input id="inputFile" @change="setImage($event.target.files[0])" type="file" hidden>
          <div class="card-header">
            <h3>Imagen del Producto</h3>
          </div>
          <label for="inputFile" class="card-body text-white text-center border" style="cursor:pointer">
            <feather class="feather-xxl" type="image" v-if='!src'/>
            <img id="priviewImage" class="img-fluid" :src="src" alt="imagen" v-else>
          </label> -->
      </div>
    </div>
  </form>
</template>

<script>
import Compressor from 'compressorjs'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'


export default {
  components: {
       vue2Dropzone       
  },
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
      name:'',
      unit_code:'',
      sale_price:'',
      new_product:'',
      description:'',
      collection_id:'',
      brand_id:'',
      category_id:'',
      color_id:'',
      size_id:'',
      product: {
        unit_code: 'NIU',
        category_id: null,
        color_id: null,
        collection_id: null,
        brand_id: null,
        size_id: null
      },
      dropzoneOptions: {
          url: 'products/product',
          thumbnailWidth: 150,
          maxFilesize: 1.5,
          addRemoveLinks : true,
          autoProcessQueue:false,
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          maxFiles:3,
          uploadMultiple: true,
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
    maxFilesAlert(file){
                Swal.fire({
                    title: 'No permitido',
                    text: 'Solo se permiten 1 archivo',
                    type: 'error',
                    confirmButtonText: 'OK'
                })
               this.$refs.tx_ruta_imagen.removeFile(file);
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
      
      let me= this;
      /*if (!this.file) {
        return this.$snotify.error('Es necesario una imagen');
      }*/
      this.$refs.image_url.processQueue();
     
                let images  = this.$refs.image_url.getAcceptedFiles();
                let index = 0;
                let files  = []
                let  data = new FormData()

                for( let i = 0; i < images.length; i++ ){
                    let file = images[i];
                    data.append('image_url[' + i + ']', file);
                }
        data.append('name', this.name)
        data.append('collection_id', this.collection_id)
        data.append('brand_id', this.brand_id)
        data.append('category_id', this.category_id )
        data.append('color_id', this.color_id )
        data.append('size_id', this.size_id )
        data.append('unit_code', this.unit_code )
        data.append('sale_price', this.sale_price )
        data.append('new_product', this.new_product )
        data.append('description', this.description )

     /* var image = await new Promise((resolve, reject) => {
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
      var path = await axios.post('products/image', formData, config).then(res => res.data);
      this.product.image_url = path;*/
      axios.post('products',data).then(res => {
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