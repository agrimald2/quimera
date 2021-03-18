@extends('quimeraLayouts.app')
@section('content')
<div id="page">
    <div id="app" class="d-flex flex-column">
		<div class="container pt-4">
		  <div class="row justify-content-center">
		    <div class="col-md-8">
		      <div class="card" style="border: 0px">
		        <div class="card-header d-none">{{ __('Login') }}</div>
		        <div class="card-body">
		          <form method="POST" action="{{ route('login') }}">
		            @csrf
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="text-left pb-3" style="border-bottom: 1px solid">
		                  <label class="form-check-label" for="remember">
		                    CLIENTE FRECUENTE
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
		                @error('email')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
		                @error('password')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row d-none">
		              <div class="col-md-6 offset-md-4">
		                <div class="form-check">
		                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                  <label class="form-check-label" for="remember">
		                    {{ __('Remember Me') }}
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row mb-0">
		              <div class="col-md-6 offset-md-4 d-flex flex-column">
		                <button type="submit" class="btn btn-primary">
		                  INGRESAR
		                </button>
		                @if (Route::has('password.request'))
		                  <a class="btn btn-link" href="{{ route('password.request') }}">
		                    {{ __('Forgot Your Password?') }}
		                  </a>
		                @endif
		              </div>
		            </div>
		          </form>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<div id="app" class="d-flex flex-column">
		<div class="container pt-4">
		  <div class="row justify-content-center">
		    <div class="col-md-8">
		      <div class="card" style="border: 0px">
		        <div class="card-header d-none">{{ __('Login') }}</div>
		        <div class="card-body">
		          <form method="POST" action="{{ route('login') }}">
		            @csrf
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="text-left pb-3" style="border-bottom: 1px solid">
		                  <label class="form-check-label" for="remember">
		                    NUEVO CLIENTE
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="NOMBRE Y APELLIDO" required autocomplete="email" autofocus>
		                @error('email')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('E-Mail Address') }}" required autocomplete="current-password">
		                @error('password')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="CONTRASEÑA" required autocomplete="current-password">
		                @error('password')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="form-check">
		                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                  <label class="form-check-label" for="remember">
		                    Quiero suscribirme al newsletter
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="form-check">
		                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                  <label class="form-check-label" for="remember">
		                    Acepto los terminos y condiciones
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row mb-0">
		              <div class="col-md-6 offset-md-4 d-flex flex-column">
		                <button type="submit" class="btn btn-primary">
		                  CREAR CUENTA
		                </button>
		              </div>
		            </div>
		          </form>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<div id="app" class="d-flex flex-column">
		<div class="container pt-4">
		  <div class="row justify-content-center">
		    <div class="col-md-8">
		      <div class="card" style="border: 0px">
		        <div class="card-header d-none">{{ __('Login') }}</div>
		        <div class="card-body">
		          <form method="POST" action="{{ route('login') }}">
		            @csrf
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="text-left pb-3" style="border-bottom: 1px solid">
		                  <label class="form-check-label" for="remember">
		                    CONTINUAR COMO INVITADO
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row mb-0">
		              <div class="col-md-6 offset-md-4 d-flex flex-column">
		                <button type="submit" class="btn btn-primary">
		                  CONTINUAR
		                </button>
		              </div>
		            </div>
		          </form>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
@endsection