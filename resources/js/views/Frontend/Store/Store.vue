<template>
  <div>
    <div class="flex flex-col gap-4
      md:flex-row">
      <!-- Filters -->
      <div class="filters">
        <div class="uppercase py-4">Filtrar por:</div>

        <!-- Category -->
        <FilterButton name="Categoria">
          <FilterButtonItem
            v-for="item in categories"
            :key="item.id"
            :name="item.name"
            @click.native="searchBy('category_id', item.id)"
          />
        </FilterButton>

        <!-- Sizes -->
        <FilterButton name="Talla">
          <FilterButtonItem
            v-for="item in sizes"
            :key="item.id"
            :name="item.name"
            @click.native="searchBy('size_id', item.id)"
          />
        </FilterButton>

        <!-- Color -->
        <FilterButton name="Color">
          <FilterButtonItem
            v-for="item in colors"
            :key="item.id"
            :name="item.name"
            @click.native="searchBy('color_id', item.id)"
          />
        </FilterButton>

        <!-- Collection -->
        <FilterButton name="Colección">
          <FilterButtonItem
            v-for="item in collections"
            :key="item.id"
            :name="item.name"
            @click.native="searchBy('collection_id', item.id)"
          />
        </FilterButton>
      </div>
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
    var categoryId = this.$route.params.categoryId;
    this.category_id = categoryId;
    console.log("este el el id ", this.category_id);
    if (this.category_id > 0) {
      this.searchBy("category_id", this.category_id);
    } else {
      axios.get("products/all").then((res) => {
        console.log(res);
        this.items = res.data.products;
      });
    }
    this.fetchData();
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
    };
  },
  computed: {
    ...mapGetters({
      sale: "sale/getSale",
      totalProducts: "sale/totalProducts",
    }),
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
    searchBy(key, id) {
      axios.get("products/" + key + "/" + id + "/searchBy").then((res) => {
        console.log("filtro by characteristic", res);
        this.items = res.data.products;
      });
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