<template>
  <form @submit.prevent="submit" class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar Producto</h3>
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
              <label for="">Precio de Venta (Incluir IGV)</label>
              <input type="number" v-model.number="product.sale_price" step="any" min="0" class="form-control" placeholder="Precio de Venta (Incluir IGV)" required>
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
export default {
  mounted() {
    this.priviewImage = this.$el.querySelector('#priviewImage');
    this.fetchData();
  },
  data() {
    return {
      resource: 'products',
      priviewImage: {},
      categories: [],
      subCategories: [],
      categories: [],
      collections: [],
      brands: [],
      srcTmp: null,
      file: null,
      product: {
        unit_code: 'NIU',
        category: null,
        sub_category: null,
      },
    }
  },
  computed: {
    src() {
      if (this.product.image_url && !this.srcTmp) {
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
      console.log(file);
      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => {
        // console.log(reader.result);
        this.srcTmp = reader.result;
        // this.priviewImage.src = reader.result;
      };
    },
    fetchData() {
      var productId = this.$route.params.productId;
      axios.get(`products/${productId}`).then(res => {
        console.log(res);
        this.product = res.data.product;
      });
      axios.get(`${this.resource}/tables`).then(res => {
        this.categories = res.data.categories
        this.collections = res.data.collections
        this.brands = res.data.brands
        this.colors = res.data.colors
        this.sizes = res.data.sizes
      })
    },
    async submit() {
      // if (!this.file) {
      //   return this.$snotify.error('Es necesario una imagen');
      // }
      var formData = new FormData();
      if (this.file) {
        formData.append('image', this.file);
        formData.append('image_url', this.product.image_url);
        var config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        try {
          var path = await axios.post('products/image', formData, config).then(res => res.data);
        } catch (error) {
          console.log(error.response);        
        }
        this.product.image_url = path;
      }
      console.log(path);
      axios.put(`products/${this.product.id}`, { product: this.product }).then(res => {
        console.log(res.data);
        this.$snotify.success('Se han guardado los cambios');
        // this.$router.replace('/products')
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>