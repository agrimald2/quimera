<section id="menu">
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="./assets/images/quimera/quimera.png" style="width: 100%">
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
                @foreach ($categories as $categoria)
                <a class="dropdown-item" href="/store/{{ $categoria['id'] }}">{{ $categoria['name'] }}</a>
                @endforeach
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ route('login') }}">NEW IN</a>
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
          <a class="navbar-brand font-black menu-account" href="{{ route('login') }}">
            MI CUENTA
          </a>
          <a class="navbar-brand font-black menu-mobile" href="{{ url('/') }}">
            Menu
            <img src="./assets/images/quimera/menu.png" style="width: 100%; margin-left: 10px;">
          </a>
          <a class="navbar-brand font-black menu-mobile" href="{{ url('/') }}">
            <img src="./assets/images/quimera/lupa.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="{{ route('login') }}">
            <img src="./assets/images/quimera/user.png" style="width: 100%">
          </a>
          <a class="navbar-brand font-black" href="{{ route('login') }}" style="width: 30px">
            <img src="./assets/images/quimera/car.png" style="width: 100%">
          </a>
        </div>  
    </nav>
</section>