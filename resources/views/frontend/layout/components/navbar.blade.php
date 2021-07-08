<div class="max-w-screen-xl mx-auto py-8">
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
        @include('frontend.layout.components.navbar_links')
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
</div>

