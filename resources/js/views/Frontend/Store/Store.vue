<template>
  <div>
    
    <div class="flex flex-col gap-4
      md:flex-row">
      <!-- Filters -->
      <div class="filters md:w-40 lg:w-48 xl:w-60">
        <div class="uppercase py-4">Filtrar por:</div>

        <!-- Category -->
        <FilterButton name="Categoria">
          <FilterButtonItem
            v-for="item in categories"
            :key="item.id"
            :name="item.name"
            @toggled="toggleFilter(filters.categories, item.id, ...arguments)"
          />
        </FilterButton>

        <!-- Sizes -->
        <FilterButton name="Talla">
          <FilterButtonItem
            v-for="item in sizes"
            :key="item.id"
            :name="item.name"
            @toggled="toggleFilter(filters.sizes, item.id, ...arguments)"
          />
        </FilterButton>

        <!-- Color -->
        <FilterButton name="Color">
          <FilterButtonItem
            v-for="item in colors"
            :key="item.id"
            :name="item.name"
            @toggled="toggleFilter(filters.colors, item.id, ...arguments)"
          />
        </FilterButton>

        <!-- Collection -->
        <FilterButton name="Colección">
          <FilterButtonItem
            v-for="item in collections"
            :key="item.id"
            :name="item.name"
            @toggled="toggleFilter(filters.collections, item.id, ...arguments)"
          />
        </FilterButton>

      </div>

      <!-- Product list -->
      <div class="flex-grow products grid grid-cols-2 gap-3 px-2
        md:grid-cols-3
        lg:grid-cols-4
        xl:grid-cols-5">
        <product-card
          :product="product"
          v-for="product in items"
          :key="product.id"
        />
      </div>
      
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import CustomerModal from "@/components/CustomerModal";
import CheckoutModal from "@/components/CheckoutModal";
import ProductCard from "@/components/ProductCard";

import FilterButton from "@/views/Frontend/Store/Components/Filter/FilterButton.vue";
import FilterButtonItem from "@/views/Frontend/Store/Components/Filter/FilterButtonItem.vue";

export default {
  components: {
    CustomerModal,
    CheckoutModal,
    ProductCard,
    FilterButton,
    FilterButtonItem,
  },

  mounted() {
    const categoryId = this.$route.params.categoryId;
    if (categoryId > 0) {
      this.filters.categories = [categoryId] 
    }
    this.fetchData();
    this.searchProductsWithFilters()
  },

  data() {
    return {
      disableds: [],
      products: [],
      categories: [],
      colors: [],
      sizes: [],
      items: [],
      collections: [],
      category_id: null,
      key: null,
      page: 0,
      itemsPerPage: 18,
      boolean: false,

      filters: {
        categories: [],
        colors: [],
        sizes: [],
        collections: [],
      },
    };
  },

  computed: {
    ...mapGetters({
      sale: "sale/getSale",
      totalProducts: "sale/totalProducts",
    })
  },

  methods: {
    ...mapActions({
      removeAllProducts: "sale/removeAllProducts",
      addProduct: "sale/addProduct",
      plusProduct: "sale/plusProduct",
      removeProduct: "sale/removeProduct",
      setSale: "sale/setSale",
      minusProduct: "sale/minusProduct",
    }),
    src(item) {
      if (item.image_url) {
        return `/api/products/${item.image_url}`;
      } else {
        return "@/assets/img/1.jpg";
      }
    },
    checkDelivery() {
      $("#shoppingModal").modal("show");
    },
    removeP(product) {},
    plusP(product) {},
    minusP(product) {},
    successCheckout(data) {},
    errorCheckout(error) {
      console.log(data);
    },
    submit(sale) {},
    
    toggleFilter(filterNamespace, id, isEnabled)
    { 
      const index = filterNamespace.findIndex((x) => x == id)
      const exists = index > -1
      
      if (isEnabled && !exists) {
        filterNamespace.push(id)
      }
      else if (exists && !isEnabled){
        filterNamespace.splice(index, 1)
      }

      this.searchProductsWithFilters()
    },

    searchProductsWithFilters() {
      axios.post("products/searchBy", this.filters).then((res) => {
        console.log("Filter by characteristic", res.data);
        this.items = res.data.products;
      })
    },


    fetchData() {
      axios.get("categories").then((res) => {
        console.log("categories store", res);
        this.categories = res.data.categories;
      });
      axios.get("colors").then((res) => {
        console.log("colors store", res);
        this.colors = res.data.colors;
      });
      axios.get("sizes").then((res) => {
        console.log("sizes store", res);
        this.sizes = res.data.sizes;
      });
      axios.get("collections").then((res) => {
        console.log("collections store", res);
        this.collections = res.data.collections;
      });
      axios.get("shoppings").then((res) => {
        console.log(res);
        this.removeAllProducts();
        var shoppings = res.data.shoppings;
        shoppings.forEach((item) => {
          var product = item.product;
          console.log(product);
          if (product) {
            product.counter = item.counter;
            console.log(product);
            this.addProduct(product);
          }
        });
      });
      axios.get("disableds/shop").then((res) => {
        console.log(res);
        this.disableds = res.data.disableds;
        axios.get("products/all").then((res) => {
          console.log(res);
          this.products = res.data.products.filter(
            (item) => !this.disableds.find((e) => e.product_id == item.id)
          );
        });
      });
    },
  },
};
</script>

<style scoped>
</style>