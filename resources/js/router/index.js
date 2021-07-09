import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
  // Shop
   {
    path: '/store/:categoryId?',
    name: 'store',
    component: require('@/views/Frontend/Store/Store.vue').default
  },
  
  // Product detail
  {
    path: '/item/:productId',
    name: 'item',
    component: require('@/views/QuimeraProduct').default
  },


  /**
   * Others
   */
  {
    path: '/offices',
    name: 'offices',
    component: require('@/views/office/Offices').default
  },
  {
    path: '/offices/create',
    name: 'offices',
    component: require('@/views/office/Create').default
  },
  {
    path: '/offices/:officeId/edit',
    name: 'offices',
    component: require('@/views/office/Edit').default
  },
  {
    path: '/setOffice',
    name: 'offices',
    component: require('@/views/office/SetOffice').default
  },
  {
    path: '/deliveryman',
    name: 'deliveryman',
    component: require('@/views/deliveryman/Deliveryman').default
  },
  {
    path: '/deliveryman/create',
    name: 'deliveryman',
    component: require('@/views/deliveryman/Create').default
  },
  {
    path: '/deliveryman/:deliverymanId/edit',
    name: 'deliveryman',
    component: require('@/views/deliveryman/Edit').default
  },
  {
    path: '/:saleId/checkout',
    name: 'checkout',
    component: require('@/views/Checkout').default
  },
  {
    path: '/:saleId/checkoutDetails',
    name: 'checkout',
    component: require('@/views/CheckoutDetails').default
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: require('@/views/Checkout').default
  },
  {
    path: '/payment',
    name: 'payment',
    component: require('@/views/Payment').default
  },
  {
    path: '/shopping',
    name: 'shopping',
    component: require('@/views/QuimeraShopping').default
  },
  {
    path: '/cart',
    name: 'cart',
    component: require('@/views/QuimeraCart').default
  },
  {
    path: '/home',
    name: 'home',
    component: require('@/views/Home').default
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: require('@/views/Home').default
  },
  {
    path: '/rawMaterial',
    name: 'rawMaterial',
    component: require('@/views/rawMaterial/RawMaterial').default
  },
  {
    path: '/rawMaterial/create',
    component: require('@/views/rawMaterial/Create').default
  },
  {
    path: '/rawMaterial/:rawMaterialId/edit',
    component: require('@/views/rawMaterial/Edit').default
  },
  {
    path: '/rawMaterial/:rawMaterialId/products',
    component: require('@/views/rawProduct/RawProducts').default
  },
  {
    path: '/rawMaterial/:rawMaterialId/:productId/create',
    component: require('@/views/rawProduct/Create').default
  },
  {
    path: '/products',
    name: 'products',
    component: require('@/views/product/Products').default
  },
  {
    path: '/products/create',
    component: require('@/views/product/Create').default
  },
  {
    path: '/products/:productId/edit',
    component: require('@/views/product/Edit').default
  },
  {
    path: '/categories',
    name: 'categories',
    component: require('@/views/category/Categories').default
  },
  {
    path: '/categories/create',
    component: require('@/views/category/Create').default
  },
  {
    path: '/categories/:categoryId/edit',
    component: require('@/views/category/Edit').default
  },
  {
    path: '/brands',
    name: 'brands',
    component: require('@/views/brand/Brands').default
  },
  {
    path: '/brands/create',
    component: require('@/views/brand/Create').default
  },
  {
    path: '/brands/:brandId/edit',
    component: require('@/views/brand/Edit').default
  },
  {
    path: '/collections',
    name: 'collections',
    component: require('@/views/collection/Collections').default
  },
  {
    path: '/collections/create',
    component: require('@/views/collection/Create').default
  },
  {
    path: '/collections/:collectionId/edit',
    component: require('@/views/collection/Edit').default
  },
  {
    path: '/colors',
    name: 'colors',
    component: require('@/views/color/Colors').default
  },
  {
    path: '/colors/create',
    component: require('@/views/color/Create').default
  },
  {
    path: '/colors/:colorId/edit',
    component: require('@/views/color/Edit').default
  },
  {
    path: '/sizes',
    name: 'sizes',
    component: require('@/views/size/Sizes').default
  },
  {
    path: '/sizes/create',
    component: require('@/views/size/Create').default
  },
  {
    path: '/sizes/:sizeId/edit',
    component: require('@/views/size/Edit').default
  },
  {
    path: '/subCategories',
    name: 'categories',
    component: require('@/views/subCategory/SubCategories').default
  },
  {
    path: '/subCategories/create',
    component: require('@/views/subCategory/Create').default
  },
  {
    path: '/subCategories/:subCategoryId/edit',
    component: require('@/views/subCategory/Edit').default
  },
  {
    path: '/deliveries',
    component: require('@/views/delivery/Deliveries').default
  },
  {
    path: '/deliveries/create',
    component: require('@/views/delivery/Create').default
  },
  {
    path: '/deliveries/:deliveryId/edit',
    component: require('@/views/delivery/Edit').default
  },
  {
    path: '/paymentMethods',
    component: require('@/views/paymentMethod/PaymentMethods').default
  },
  {
    path: '/paymentMethods/create',
    component: require('@/views/paymentMethod/Create').default
  },
  {
    path: '/paymentMethods/:paymentMethodId/edit',
    component: require('@/views/paymentMethod/Edit').default
  },
  {
    path: '/stock',
    component: require('@/views/inventory/Stock').default
  },
  {
    path: '/inventories',
    component: require('@/views/inventory/Inventories').default
  },
  {
    path: '/inventoriesAdmin',
    component: require('@/views/inventory/InventoriesAdmin').default
  },
  {
    path: '/inventories/:productId/detailsAdmin',
    component: require('@/views/inventory/DetailsAdmin').default
  },
  {
    path: '/inventories/create',
    component: require('@/views/subCategory/Edit').default
  },
  {
    path: '/inventories/:productId/create',
    component: require('@/views/inventory/Create').default
  },
  {
    path: '/inventories/:productId/details',
    component: require('@/views/inventory/Details').default
  },
  {
    path: '/customers',
    component: require('@/views/customer/Customers').default
  },
  {
    path: '/customers/:customerId/edit',
    component: require('@/views/customer/Edit').default
  },
  {
    path: '/customers/:customerId/details',
    component: require('@/views/customer/Details').default
  },
  {
    path: '/salesAdmin',
    component: require('@/views/sale/SalesAdmin').default
  },
  {
    path: '/sales',
    component: require('@/views/sale/Sales').default
  },
  {
    path: '/sales/:saleId/details',
    component: require('@/views/sale/Details').default
  },
  {
    path: '/sales/:saleId/edit',
    component: require('@/views/sale/PosAdmin').default
  },
  {
    path: '/sales/deliveries',
    component: require('@/views/sale/Deliveries').default
  },
  {
    path: '/sales/dispatcheds',
    component: require('@/views/sale/Dispatcheds').default
  },
  {
    path: '/salesdetail',
    component: require('@/views/sale/SalesDetail').default
  },
  {
    path: '/pos',
    component: require('@/views/pos/Pos').default
  },
  {
    path: '/posAdmin',
    component: require('@/views/pos/PosAdmin').default
  },
  {
    path: '/deletedReasons',
    component: require('@/views/deletedReason/DeletedReasons').default
  },
  {
    path: '/users',
    component: require('@/views/user/Users').default
  },
  {
    path: '/users/create',
    component: require('@/views/user/Create').default
  },
  {
    path: '/users/:userId/edit',
    component: require('@/views/user/Edit').default
  },
  {
    path: '/users/:userId/credentials',
    component: require('@/views/user/Credentials').default
  },
  {
    path: '/deletedReasons/create',
    component: require('@/views/deletedReason/Create').default
  },
  {
    path: '/deletedReasons/:deletedReasonId/edit',
    component: require('@/views/deletedReason/Edit').default
  },
  {
    path: '/inventory/Details_Test/:code_inventorie',
    component: require('@/views/inventory/Details_Test').default
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
