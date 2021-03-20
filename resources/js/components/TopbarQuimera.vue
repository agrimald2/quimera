<template>
  <section id="menu">
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#">
          <img src="@/assets/img/quimera/quimera.png" style="width: 100%">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav menu-hover">
            <li class="nav-item">
              <a class="nav-link font-black" href="/">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/store">SHOP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">NEW IN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="/login">SALE</a>
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
          <a class="navbar-brand font-black" href="/login" style="width: 30px">
            <img src="@/assets/img/quimera/car.png" style="width: 100%">
          </a>
        </div>  
    </nav>
  </section>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters({
      products: 'sale/products',
    }),
  }
}
</script>