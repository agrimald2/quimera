<template>
  <div class="row">
    <payment-sale-modal :sale="sale" @confirm="payedSale"></payment-sale-modal>
    <delete-modal :sale="sale" @confirm="fetchData"/>
    <div class="col">
      <find-input v-model="key" @confirm="findSales"/>
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">Ventas Detalles</h3>
            <div class="btn-toolbar" v-if="salesdetails.length">
              <button type="button" class="btn btn-info" @click="ExportExcel">
                <feather type="download"/>
                Exportar Excel
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <caption>
              <page-navigation v-model="page" :pages="pages" :count="count" :items="salesdetails.length" @confirm="fetchData"/>
            </caption>
            <thead>
              <th>F/H de venta</th>
              <th>Cliente</th>
              <th>Codigo</th>
              <th>Distrito</th>
              <th>F. de Entrega</th>
              <th>Pagado</th>
              <th>Entrega</th>
              <th>Anulado</th>
            </thead>
            <tbody>
              <tr v-for="item in salesdetails" :key='item.id'>
                <td>{{ formatDate(item.created_at) }} / {{ formatTime(item.created_at) }}</td>
                <td>{{ item.name }}</td>
                <td>{{ formatCode(item.id) }}</td>
                <td>{{ item.address }}</td>
                <td>{{ formatDate(item.delivery_date) }}</td>
                <td v-if="item.payment_id">Pagado</td>
                <td v-else>Pendiente</td>
                <td v-if="item.delivered_date">Entregado</td>
                <td v-else-if="item.dispatched_date">Despachado</td>
                <td v-else-if="item.deliver_date">Pendiente</td>
                <td v-else>S/C entrega</td>
                <td v-if="item.deleted_at">Si</td>
                <td v-else>No</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DeleteModal from '@/components/DeleteModal'
import FindInput from '@/components/FindInput'
import PaymentSaleModal from '@/components/PaymentSaleModal'
import { excelUtils } from '@/mixins'
import moment from 'moment-timezone'

export default {
  components: {
    DeleteModal,
    FindInput,
    PaymentSaleModal,
  },
  mixins: [excelUtils],
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      key: null,
      sale: {},
      salesdetails: [],
      page: 1,
      pages: null,
      count: null,
      sd: moment().startOf('day'),
      ed: moment().startOf('day'),
      deleted: null,
      payed: null,
      delivered: null,
    }
  },
  methods: {
    clearFilters() {
      this.deleted = null;
      this.payed = null;
      this.delivered = null;
      this.fetchData();
    },
    payedSale(sale) {      
      axios.put(`sales/pay`, { sale }).then(res => {        
        this.fetchData();
      }).catch(err => {
        console.log(err.response);
      });
    },
    deliverSale(sale) {
      sale.deliver_date = moment().startOf('day');
      axios.put(`sales/${sale.id}`, { sale }).then(res => {
        console.log(res);
        this.fetchData();
      }).catch(err => {
        console.log(err.response);
      });
    },
    deliveredSale(sale) {
      axios.get(`sales/${sale.id}/delivery`).then(res => {
        console.log(res);
        this.fetchData();
      }).catch(err => {
        console.log(err.response);
      });
    },
    findSales() {
      var params = { 
        key: this.key,
      };
      axios.get('salesdetails/find', { params }).then(res => {
        console.log(res.data);
        this.salesdetails = res.data.salesdetails;
      }).catch(err => {
        console.log(err.response);
      });
    },
    fetchData() {
      var params = { 
        page: this.page,
        sd: this.sd.format(),
        ed: this.ed.format(),
        payed: this.payed,
        deleted: this.deleted,
        delivered: this.delivered,
      };
      axios.get('salesdetails', { params }).then(res => {
        console.log(res);
        this.salesdetails = res.data.salesdetails;
        this.pages = res.data.pages;
        this.count = res.data.count;
      }).catch(err => {
        console.log(err.response);
      });
    },
    ExportExcel() {
        var wscols = [20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20];
        var body = [];
        let salesdetalles = this.salesdetails;
        body.push([
          'F/H DE VENTA',
          'CLIENTE',
          'CODIGO',
          'DISTRITO',
          'F. DE ENTREGA'
        ]);
        salesdetalles.forEach(item => {
          body.push([
            item.created_at,
            item.name,
            item.id,
            item.address,
            item.delivery_date
          ]);
        });
        var name = `VentaDetalles`;
        this.getExcel(body, name, [], wscols);
    },
  }
}
</script>

<style>

</style>