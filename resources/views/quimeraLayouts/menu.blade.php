<section id="menu">
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ asset('assets/images/quimera/quimera.png') }}" style="width: 100%">
        </a>
        <div class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" id="toggle-boton">
          <a class="navbar-brand font-black menu-mobile">
            <img src="{{ asset('assets/images/quimera/menu.png') }}" style="width: 100%; margin-left: 10px;">
          </a>
          <span class="navbar-toggler-icon"></span>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav menu-hover">
            <li class="nav-item">
              <a class="nav-link font-black" href="{{ url('/') }}">HOME</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle font-black" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SHOP</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               
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
            <input style="border:1px solid; padding: 0 10px" type="text" placeholder="Buscar" id="search" name="search">
            <div class="search">
              <img src="{{ asset('assets/images/quimera/lupa.png') }}" style="width: 100%">
            </div>
          </div>
          <a class="navbar-brand font-black menu-account" href="{{ route('login') }}">
            MI CUENTA
          </a>
          <a class="navbar-brand font-black" href="{{ url('/') }}">
              <img src="{{ asset('assets/images/quimera/lupa.png') }}" style="width: 100%">
            </a>
            <a class="navbar-brand font-black" href="{{ route('login') }}">
              <img src="{{ asset('assets/images/quimera/user.png') }}" style="width: 100%">
            </a>
        </div>  
    </nav>
</section>

