export const modules = {
  namespaced: true,
  state: {
    currentModule: { label: 'Dashboard' },
    modules: [
      { label: 'Dashboard', name: 'dashboard', path: '/dashboard', icon: 'pie-chart' },
      //{ label: 'Punto de Venta', name: 'pos', path: '/pos', icon: 'monitor' },
      { label: 'Punto de Venta', name: 'posAdmin', path: '/posAdmin', icon: 'monitor' },
      //{ label: 'Materia Prima', name: 'rawMaterial', path: '/rawMaterial', icon: 'archive' },
      { label: 'Productos', name: 'products', path: '/products', icon: 'package' },
      { label: 'Inventario', name: 'inventories', path: '/inventories', icon: 'clipboard' },
      //{ label: 'Invent. ADM', name: 'inventoriesAdmin', path: '/inventoriesAdmin', icon: 'clipboard' },

      /*Customers Widget */
      { label: 'Widgets', name: 'widgets', path: '/widgets' },
      /*End Customers */

      /*{ label: 'Categorias', name: 'categories', path: '/categories', icon: 'package' },
      { label: 'Marcas', name: 'brands', path: '/brands', icon: 'package' },
      { label: 'Colores', name: 'colors', path: '/colors', icon: 'package' },
      { label: 'Colecciones', name: 'collections', path: '/collections', icon: 'package' },
      { label: 'Tallas', name: 'sizes', path: '/sizes', icon: 'package' },*/
      //{ label: 'Stock', name: 'stock', path: '/stock', icon: 'clipboard' },
      { label: 'Clientes', name: 'customers', path: '/customers', icon: 'users' },
      { label: 'Ventas', name: 'sales', path: '/sales', icon: 'check' },
      { label: 'Ventas Detalle', name: 'salesdetail', path: '/salesdetail', icon: 'check' },
      { label: 'Ventas(Admin)', name: 'salesAdmin', path: '/salesAdmin', icon: 'check' },
      { label: 'Despacho', name: 'dispatchedsSale', path: '/sales/dispatcheds', icon: 'map-pin' },
      { label: 'Delivery', name: 'deliveriesSale', path: '/sales/deliveries', icon: 'map-pin' },
      { label: 'Usuarios', name: 'users', path: '/users', icon: 'users' },
      { label: 'Sucursales', name: 'offices', path: '/offices', icon: 'home' },
      // { label: 'Repartidores', name: 'deliveryman', path: '/deliveryman', icon: 'user-check' },
      { label: 'L. de envio', name: 'deliveries', path: '/deliveries', icon: 'map-pin' },
      { label: 'M. de pago', name: 'paymentMethods', path: '/paymentMethods', icon: 'map-pin' },
      { label: 'M. de anulacion', name: 'deletedReasons', path: '/deletedReasons', icon: 'star' },
    ]
  },
  mutations: {
    SET_CURRENT_MODULE(state, data) {
      state.currentModule = data;
    }
  },
  actions: {
    fetchCurrentModule({ commit }, currentModule) {
      commit("SET_CURRENT_MODULE", currentModule);
    }
  },
  getters: {
    modules(state) {
      return state.modules;
    },
    currentModule(state) {
      return state.currentModule;
    }
  }
}
