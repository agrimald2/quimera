<template>
<div class="modal fade" id="editSaleModal" tabindex="-1" role="dialog">
  <form @submit.prevent="submit" class="modal-dialog modal-lg" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar datos de Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Distrito de envio
          </label>
          <div class="col">
            <select v-model="delivery" class="custom-select" required>
              <option :value="null">SELECCIONE DISTRITO DE ENVIO...</option>
              <option v-for="item in deliveries" :value="item" :key="item.id">
                {{ item.name }} / Precio: S/ {{ item.price.toFixed(2) }}
              </option>
            </select>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Fecha de envio
          </label>
          <div class="col d-flex align-items-center">
            <datepicker v-model="delivery_date" append="F. de entrega"/>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            DNI del cliente
          </label>
          <div class="col">
            <input type="text" v-model="customer.document" maxlength="8" class="form-control" placeholder="DNI del cliente" @input="findCustomer" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Nombres del cliente
          </label>
          <div class="col">
            <input type="text" v-model="customer.name" class="form-control" placeholder="Nombres del cliente" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Celular del cliente
          </label>
          <div class="col">
            <input type="text" v-model="customer.mobile" maxlength="9" class="form-control" placeholder="Mobile del cliente" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Email del cliente
          </label>
          <div class="col">
            <input type="email" v-model="customer.email" class="form-control" placeholder="Email del cliente" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Direccion del cliente
          </label>
          <div class="col">
            <input type="text" v-model="customer.address" class="form-control" placeholder="Direccion del cliente" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Referencia de la direccion
          </label>
          <div class="col">
            <input type="text" v-model="customer.reference" class="form-control" placeholder="Referencia de la direccion" required>
          </div>
        </div>
        <div class="row form-group">
          <label for="" class="col-form-label col-md-3">
            Observaciones de la venta
          </label>
          <div class="col">
            <textarea v-model="sale.observations" class="form-control" rows="3" placeholder="Observaciones de la venta"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <h4>Total: S/ {{ total }}</h4>
        <div class="btn-toolbar">
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import moment from 'moment-timezone'

export default {
  mounted() {
    this.fetchData();
  },
  props:['sale'],
  data() {
    return {
      delivery_date: moment(),
      delivery: null,
      deliveries: [],
      customer: {},
    }
  },
  watch:{
    sale: function(val){
      this.customer = val.customer
      this.delivery_date = val.delivery_date
      this.delivery = val.delivery
    }
  },
  computed: {
    total(){
      return (this.sale.items.map(e => e.sale_price * e.weight).reduce((a, b) => a + b, 0) + (this.delivery ? this.delivery.price : 0)).toFixed(2)
    }
  },
  methods: {
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
      this.$loading(true)
      if (this.customer._id) {
        axios.put('customers', { customer: this.customer }).then(res => {
          console.log(res);
          var customer = res.data.customer;
          var new_sale = Object.assign({}, this.sale);
          new_sale.delivery_date = this.delivery_date;
          new_sale.delivery_id = this.delivery.id;
          new_sale.delivery_price = this.delivery.price;
          new_sale.customer_id = customer.id;
          new_sale.email = customer.email;
          this.$emit('confirm', new_sale);
          // this.customer = {};
          // this.sale = {
          //   processPayment: false,
          //   deliver_date: null,
          //   payment_id: null,
          //   payment_method_id: null,
          // };
        });
      } else {
        axios.post('customers', { customer: this.customer }).then(res => {
          console.log(res);
          var customer = res.data.customer;
          var new_sale = Object.assign({}, this.sale);
          new_sale.delivery_date = this.delivery_date;
          new_sale.delivery_id = this.delivery.id;
          new_sale.delivery_price = this.delivery.price;
          new_sale.customer_id = customer.id;
          new_sale.email = customer.email;
          this.$emit('confirm', new_sale);
          // this.customer = {};
          // this.sale = {
          //   processPayment: false,
          //   deliver_date: null,
          //   payment_id: null,
          //   payment_method_id: null,
          // };
        });
      }
      $('.modal').modal('hide');
    },
    fetchData() {
      axios.get('deliveries').then(res => {
        console.log(res);
        this.deliveries = res.data.deliveries;
      });
    }
  }
}
</script>

<style>

</style>