<template>
<div class="modal fade" id="shoppingModal" role="dialog">
  <div class="modal-dialog">
    <form @submit.prevent="submit" class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Quimera - {{type_payment}}</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="email">Por favor, ingrese su DNI, teléfono y dirección de entrega</label>
          <select class="custom-select" v-model="delivery" required v-if="type_payment=='Express'">
            <option :value="null">SELECCIONE EL DISTRITO DE ENVIO...</option>
            <option v-for="item in deliveries" :value="item" :key="item.id" >{{ `${item.name} envio: S/ ${item.price.toFixed(2)}` }}</option>
            <option v-if="type_payment=='DHL'">Paises</option>
          </select>
          <select class="custom-select" v-model="delivery" required v-if="type_payment=='DHL'">
            <option :value="null">SELECCIONE EL DISTRITO DE ENVIO...</option>
            <option >DHL</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" v-model="customer.document" class="form-control" placeholder="Tu N° de DNI" minlength="8" maxlength="8" @input="findCustomer" required>
        </div>
        <div class="form-group">
          <input type="text" v-model="customer.name" class="form-control" placeholder="Tus nombres" required>
        </div>
        <div class="form-group">
          <input type="text" v-model="customer.mobile" class="form-control" placeholder="Numero de celular" minlength="9" maxlength="9" required>
        </div>
        <div class="form-group">
          <input type="email" v-model="customer.email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="text" v-model="customer.address" class="form-control" placeholder="Direccion de entrega" required>
        </div>
        <div class="form-group">
          <input type="text" v-model="customer.reference" class="form-control" placeholder="Referencia de la direccion" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark" style="color:white">
          Siguiente
        </button>
      </div>
    </form>
  </div>
</div>
</template>

<script>
export default {

  props:['type_payment'],
  mounted() {
    this.fecthData();
  },
  data() {
    return {
      delivery: null,
      deliveries: [],
      customer: {},
    }
  },
  methods: {
    fecthData() {
      axios.get('deliveries').then(res => {
        console.log(res);
        this.deliveries = res.data.deliveries;
      });
    },
    findCustomer() {
      if (this.customer.document.length == 8) {
        var params = {
          dni: this.customer.document,
        };
        axios.get('customers/byDni', { params }).then(res => {
          console.log(res);
          this.customer = res.data.customer;
        }).catch(err => {
          console.log(err.response);
        });
      }
    },
    submit() {
      $('.modal').modal('hide');
      this.$loading(true);
      axios.post('customers', { customer: this.customer ,  token: this.token }).then(res => {
        console.log(this.delivery);
        var customer = res.data.customer;
        var sale = {
          customer_id : customer.id,
          delivery_id : this.deliveries.id, // causa de que no funcione, devuelve null en lugar de una coleccion
          delivery_price : this.deliveries.price, // causa de que no funcione, devuelve null en lugar de una coleccion
          email : customer.email,
        };
        //this.$loading(false);
        console.log(sale);
        this.$emit('confirm', sale);
      }).catch(err => {
        console.log(err.response);
      });
    }
  }
}
</script>

<style>

</style>