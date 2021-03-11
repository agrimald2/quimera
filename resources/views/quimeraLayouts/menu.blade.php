<section id="menu">
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="./assets/images/quimera/quimera.png" style="width: 100%">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav menu-hover">
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">SHOP</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">NEW IN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">SALE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">OUTLET</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">COLECCIONES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">GIFTCARD</a>
            </li>
          </ul>
        </div>
        <div class="d-flex">
          <div class="d-flex search-section">
            <input style="border:1px solid" type="text" placeholder="Buscar" id="search" name="search">
            <div class="search">
              <img src="./assets/images/quimera/lupa.png" style="width: 100%">
            </div>
          </div>
          <a class="navbar-brand font-black menu-account" href="{{ url('/') }}">
            MI CUENTA
          </a>
          <a class="navbar-brand font-black menu-mobile" href="{{ url('/') }}">
            Menu
            <img src="./assets/images/quimera/menu.png" style="width: 100%; margin-left: 10px;">
          </a>
          <a class="navbar-brand font-black menu-mobile" href="{{ url('/') }}">
            <img src="./assets/images/quimera/lupa.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="{{ url('/') }}">
            <img src="./assets/images/quimera/user.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="{{ url('/') }}" style="width: 30px">
            <img src="./assets/images/quimera/car.png" style="width: 100%">
          </a>
        </div>  
    </nav>
</section>