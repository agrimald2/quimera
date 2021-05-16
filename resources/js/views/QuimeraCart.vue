<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4 d-flex justify-content-center">
        <section class="col-lg-8 d-flex flex-column text-center" style="position: relative;">
          <label class="text-left w-100 mb-2" for="card_name" style="margin-bottom: 0px;font-size: 18px; border-bottom: 1px solid #e0cfc7ff;">Carrito de Compras</label>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Detalles</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in carts" :key="index">
                            <th scope="row">
                                <img :src="src(row)" style="width: 100px;">
                            </th>
                            <td>{{row.name}}</td>
                            <td>
                                <p>Color: </p>
                                <p>Talla: </p>
                            </td>
                            <td><input @change="updateCart(row)" type="number" name="quantity" :min="1" class="form-controls input-number" v-model="row.quantity"></td>
                            <td>{{symbol}} {{parseFloat(row.unit_price).toFixed(2)}}</td>
                            <td>{{symbol}} {{(parseFloat(row.total).toFixed(2))}}</td>
                            <td><a href="#" @click="removeCartProduct(index)"><feather type="trash-2"/></a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right" colspan="5">Total</th>
                            <td>{{symbol}} {{(total).toFixed(2)}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
          <!-- <div class="row d-flex w-100 mt-4 mb-4" style="align-items: center;">
            <a class="col-lg-6 d-flex justify-content-end w-50" href="/store/1"><img src="@/assets/img/quimera/boot-black-back.png" class="" style="width: 100%; height:100%"></a>
            <div class="col-lg-6 d-flex flex-column pl-4 w-50 shopping-font-details">
              <label class="text-left" for="card_name" style="margin-bottom: 0px;">MARIA BOOTS HUESO</label>
              <label class="text-left" for="card_name" style="margin-bottom: 0px;">COLOR: Negro</label>
              <label class="text-left" for="card_name" style="margin-bottom: 0px;">TALLA: 36</label>
              <label class="text-left" for="card_name" style="margin-bottom: 0px;">CANTIDAD: 1</label>
              <label class="text-left" for="card_name" style="margin-bottom: 0px;">PRECIO: S/.459</label>
              <a class="d-flex mt-2" style="align-content: flex-start;" href="/shopping"><i class="fa fa-trash"></i></a>
            </div>
          </div> -->
          <div class="d-flex flex-column align-items-center w-100"
          style="align-self: center; border-top: 1px solid #e0cfc7ff; padding: 40px 0px">
            <!-- <button type="submit" class="btn button-pink shopping-button-size d-flex" style="background:white;padding: 5px; border: 1px solid #e0cfc7ff;justify-content: center;">
              ACTUALIZAR CARRITO
            </button> -->
            <div class="d-flex justify-content-center mt-2 mb-4 shopping-button-size" style="padding: 0px !important">
                <div class="newsletterForm w-25" style="background:#e0cfc7ff;color:black;padding: 5px">
                  <label style="margin: 0px;">APLICAR</label>
                </div>
                <input style="border:1px solid #e0cfc7ff;padding: 5px" class="w-75" type="text" id="search" name="search" placeholder="CODIGO DESCUENTO">
            </div> 
              <button
                type="button"
                style="padding: 5px;justify-content: center;"
                class="button-pink shopping-button-size d-flex"
                @click="showModal"
              >COMPRAR</button>
          </div> 
        </section>
      </div>

      <modal-payment
        v-show="isModalVisible"
        @close="closeModal"
      >
        <template v-slot:header>
          Client Information
        </template>

        <template v-slot:body>
          <form ref="form" @submit.stop.prevent="handleSubmit">
            <div class="form-group row">
              <div class="col-md-12">
                <input type="text" v-model="name" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="NOMBRE Y APELLIDO" required autocomplete="email" autofocus>
              </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="email" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="CORREO ELECTRONICO" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="col-md-6" style="padding-left: 0px !important">
                  <input type="text" v-model="pais" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="PAIS" required autocomplete="email" autofocus>
                </div>
                <div class="col-md-6" style="padding-right: 0px !important">
                  <input type="text" v-model="telefono" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="TELEFONO" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="provincia" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="PROVINCIA / ESTADO / REGION" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="districto" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="DISTRICTO" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="direccion" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="DIRECCION" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="interior" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="INTERIOR" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="referencia" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="REFEENCIA" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="col-md-6" style="padding-left: 0px !important">
                  <input type="text" v-model="documento" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="TIPO DE DOCUMENTO" required autocomplete="email" autofocus>
                </div>
                <div class="col-md-6" style="padding-right: 0px !important">
                  <input type="text" v-model="nroducumento" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="NRO DOCUMENTO" required autocomplete="email" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" v-model="fechanac" style="border: 1px solid #e0cfc7ff" class="form-control input-pink" placeholder="FECHA DE NACIMIENTO" required autocomplete="email" autofocus>
                </div>
            </div>
          </form>
        </template>

        <template v-slot:footer>
          
        </template>
      </modal-payment>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import CustomerModal from '@/components/CustomerModal'
import CheckoutModal from '@/components/CheckoutModal'
import ModalPayment from '@/components/QuimeraModalPayment';

export default {
  components: {
    CustomerModal,
    CheckoutModal,
    ModalPayment,
  },
  mounted() {
    axios.get('shoppings').then(res => {
      console.log(res);
      this.removeAllProducts();
      var shoppings = res.data.shoppings;
      shoppings.forEach(item => {
        var product = item.product;
        if (product) {
          product.counter = item.counter;
          console.log(product);
          product.inventory = product.inventory_shop;
          // product.inventory = product.inventory_all.filter(e => e.office_id == 1);
          this.addProduct(product);
        }
      });
    });
  },
  data() {
    return {
        token: process.env.VUE_APP_TOKEN || 'TEST-dd114825-b697-4ce1-9f03-e5fce322b40f',
        delivery: null,
        customer: {},
        deliveries: [],
        name: '',
        email: '',
        pais: '',
        telefono: '',
        provincia: '',
        districto: '',
        direccion: '',
        interior: '',
        referencia: '',
        documento: '',
        nroducumento: '',
        fechanac: '',
        isModalVisible: false,
        carts: [],
        total: 0,
        customer: {},
        decrementDisabled: false,
        symbol: 'S/',
    }
  },
   async created() {
        this.$eventHub.$on('reloadCart', () => {
            this.localStorageProduct()
        })
        this.localStorageProduct()
    },
  computed: {
    ...mapGetters({
      sale: 'sale/getSale',
      products: 'sale/products',
      totalProducts: 'sale/totalProducts',
    }),
  },
  methods: {
    ...mapActions({
      removeAllProducts: 'sale/removeAllProducts',
      addProduct: 'sale/addProduct',
      plusProduct: 'sale/plusProduct',
      removeProduct: 'sale/removeProduct',
      setSale: 'sale/setSale',
      minusProduct: 'sale/minusProduct',
    }),
    localStorageProduct(){
        if(localStorage.getItem('carts')){
            this.carts = JSON.parse(localStorage.getItem('carts'))
            this.total = this.carts.reduce((total, item) => {
                return total + item.quantity * item.unit_price
            }, 0);
            
            localStorage.setItem('total', this.total);
        }
        this.$eventHub.$emit('reloadData')
    },
    removeCartProduct(index){
        this.carts.splice(index, 1)
        this.storeCartProduct()
    },
    storeCartProduct(){
        let parsed = JSON.stringify(this.carts)
        localStorage.setItem('carts', parsed)
        this.localStorageProduct()
    },
    updateCart(product) {  
        
        const searchProduct = this.carts.findIndex((item) => {
            return item.item_id === product.item_id;
        });
        if (this.carts[searchProduct].item_id === product.item_id) {
            
            if(this.carts[searchProduct].quantity > 0){
                this.carts[searchProduct].quantity = parseInt(product.quantity)
                this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
                localStorage.setItem('carts' , JSON.stringify(this.carts));
                this.localStorageProduct()
            }else{
                this.removeCartProduct(searchProduct)
            }   
        }
        this.$eventHub.$emit('reloadData')
        this.$eventHub.$emit('reloadDetail')
    },
    decrement(product){
        const searchProduct = this.carts.findIndex((item) => {
            return item.item_id === product.item_id;
        });

        let val = parseInt(product.quantity)
        this.carts[searchProduct].quantity = val - 1

        if(this.carts[searchProduct].quantity > 0){
            this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
            localStorage.setItem('carts' , JSON.stringify(this.carts));
            this.localStorageProduct()
        }else{
            this.removeCartProduct(searchProduct)
        }
        this.$eventHub.$emit('reloadData')
        this.$eventHub.$emit('reloadDetail')
    },
    increment(product){
        const searchProduct = this.carts.findIndex((item) => {
            return item.item_id === product.item_id;
        });

        let val = parseInt(product.quantity)
        this.carts[searchProduct].quantity = val + 1

        if(this.carts[searchProduct].quantity > 0){
            
            this.carts[searchProduct].total = this.carts[searchProduct].quantity * this.carts[searchProduct].unit_price;
            localStorage.setItem('carts' , JSON.stringify(this.carts));
            this.localStorageProduct()
        }else{
            this.removeCartProduct(searchProduct)
        }
        this.$eventHub.$emit('reloadData')
        this.$eventHub.$emit('reloadDetail')
    },
    src(item) {
      if (item.image) {
        return `/api/products/${item.image}`;
      } else {
        return "@/assets/img/1.jpg";
      }
    },
    showModal() {
        this.isModalVisible = true;
      },
    closeModal() {
      this.isModalVisible = false;
    },
    checkFormValidity() {
      /*const valid = this.$refs.form.checkValidity()
      this.nameState = valid
      return valid*/
    },
    resetModal() {
      //this.name = ''
      //this.nameState = null
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      //bvModalEvt.preventDefault()
      // Trigger submit handler
      //this.handleSubmit()
    },
    handleSubmit() {
      // Exit when the form isn't valid
      //if (!this.checkFormValidity()) {
      //  return
      //}
      // Push the name to submitted names
      //this.submittedNames.push(this.name)
      // Hide the modal manually
      //this.$nextTick(() => {
      //  this.$bvModal.hide('modal-prevent-closing')
      //})
    },
    checkDelivery() {
      $('#shoppingModal').modal('show');
    },
    removeP(product) {
      axios.delete(`shoppings/${product.id}`).catch(err => {
        console.log(err.response);
      });
      this.removeProduct(product);
    },
    plusP(product) {
      console.log(product);
      this.plusProduct(product);
      axios.post('shoppings', { product }).catch(err => {
        console.log(err.response);
      });
    },
    minusP(product) {
      this.minusProduct(product);
      axios.post('shoppings', { product }).catch(err => {
        console.log(err.response);
      });
    },
    successCheckout(data) {
      this.$router.replace(`/${data.sale.id}/checkoutDetails`);
      axios.get('shoppings/removeAll').catch(err => {
        console.log(err.response);
      });
      this.removeAllProducts();
      console.log(data);
      location.reload();
    },
    errorCheckout(error) {
      console.log(data);
    },
    submit(sale) {
      var inventories = [];
      this.products.forEach(item => {
        inventories.push(...this.checkInventory(item));
      });
      if (inventories.length) {
        console.log('submit(sale) ==>');
        this.setSale(sale);
        $('.modal').modal('hide');
        $('#checkoutModal').modal('show');
      } else {
        this.$snotify.error('Debe haber almenos un producto disponible');
        $('.modal').modal('hide');
      }
      this.$loading(false);
    },
  }
}
</script>