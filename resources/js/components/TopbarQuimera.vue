<template>
   <!--<nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="/">
          <img src="@/assets/img/quimera/quimera.png" style="width: 100%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav menu-hover">
            <li class="nav-item">
              <a class="nav-link font-black" href="/">HOME</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" data-target="#navbarDropdown" aria-haspopup="true" aria-expanded="false">SHOP</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/store/1">stickers</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">NEW IN</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SALE</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">34</a>
                <a class="dropdown-item" href="#">35</a>
                <a class="dropdown-item" href="#">36</a>
                <a class="dropdown-item" href="#">37</a>
                <a class="dropdown-item" href="#">38</a>
                <a class="dropdown-item" href="#">39</a>
                <a class="dropdown-item" href="#">40</a>
                <a class="dropdown-item" href="#">41</a>
                <a class="dropdown-item" href="#">42</a>
                <a class="dropdown-item" href="#">43</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">OUTLET</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">COLECCIONES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">GIFTCARD</a>
            </li>
          </ul>
        </div>
        <div class="d-flex">
          <div class="d-flex search-section">
            <input style="border:1px solid" type="text" placeholder="Buscar" id="search" name="search">
            <div class="search">
              <img src="@/assets/img/quimera/lupa.png" style="width: 100%">
            </div>
          </div>
          <a class="navbar-brand font-black menu-account" href="/login">
            MI CUENTA
          </a>
          <a class="navbar-brand font-black menu-mobile" href="#">
            Menu
            <img src="@/assets/img/quimera/menu.png" style="width: 100%; margin-left: 10px;">
          </a>
          <a class="navbar-brand font-black menu-mobile" href="#">
            <img src="@/assets/img/quimera/lupa.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="/login">
            <img src="@/assets/img/quimera/user.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="#" style="width: 30px">
            <img src="@/assets/img/quimera/car.png" style="width: 100%">
          </a>
        </div>  
  </nav>
  <div id="app">
    <nav-bar msg="String"></nav-bar>
  </div>-->


  <!--<nav class="navbar navbar-expand-lg navbar-light bg-light" v-bind:class=" { 'navbarOpen': show }">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" @click.stop="toggleNavbar()">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent" v-bind:class="{ 'show': show }">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
              </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
      </div>
  </nav>-->


  <section id="menu">
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#">
          <img src="@/assets/img/quimera/quimera.png" style="width: 100%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav menu-hover">
            <li class="nav-item">
              <a class="nav-link font-black" href="/">HOME</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SHOP</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" v-for="item in categories" :key="item.id" 
                  @click.prevent="category_id = item.id; page = 0" :href="'/store/' + item.id">{{ item.name }}</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">NEW IN</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-black" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SALE</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">34</a>
                <a class="dropdown-item" href="#">35</a>
                <a class="dropdown-item" href="#">36</a>
                <a class="dropdown-item" href="#">37</a>
                <a class="dropdown-item" href="#">38</a>
                <a class="dropdown-item" href="#">39</a>
                <a class="dropdown-item" href="#">40</a>
                <a class="dropdown-item" href="#">41</a>
                <a class="dropdown-item" href="#">42</a>
                <a class="dropdown-item" href="#">43</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">OUTLET</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">COLECCIONES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">GIFTCARD</a>
            </li>
          </ul>
        </div>
        <div class="d-flex">
          <div class="d-flex search-section">
            <input style="border:1px solid" type="text" placeholder="Buscar" id="search" name="search">
            <div class="search">
              <img src="@/assets/img/quimera/lupa.png" style="width: 100%">
            </div>
          </div>
          <a class="navbar-brand font-black menu-account" href="/login">
            MI CUENTA
          </a>
          <a class="navbar-brand font-black menu-mobile" href="/">
            Menu
            <img src="@/assets/img/quimera/menu.png" style="width: 100%; margin-left: 10px;">
          </a>
          <a class="navbar-brand font-black menu-mobile" href="/">
            <img src="@/assets/img/quimera/lupa.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="/login">
            <img src="@/assets/img/quimera/user.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="/cart" style="width: 30px">
            <img src="@/assets/img/quimera/car.png" style="width: 100%">
          </a>
        </div>  
    </nav>
  </section>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  mounted() {
    var categoryId = this.$route.params.categoryId;
    this.category_id = categoryId;
    this.fetchData();
  },
  props: {
    msg: String
  },
  data() {
    return {
      categories: [],
      show: true
    }
  },
  computed: {
    ...mapGetters({
      products: 'sale/products',
    }),
  },
  methods: {
    fetchData() {
      axios.get('categories').then(res => {
        console.log('busqueda categorias',res);
        this.categories = res.data.categories;
      });
    },
    toggleNavbar() {
      this.show = !this.show
    }
  }
}
</script>