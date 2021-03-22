@extends('quimeraLayouts.appLogin')
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
		                <div class="text-left pb-3" style="border-bottom: 1px solid #e0cfc7ff">
		                  <label class="form-check-label" for="remember">
		                    CLIENTE FRECUENTE
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
		                @error('email')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password" type="password" style="border: 1px solid #e0cfc7ff" class="form-control @error('password') is-invalid @enderror input-pink" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
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
		                <button type="submit" class="btn button-pink">
		                  INGRESAR
		                </button>
		                @if (Route::has('password.request'))
		                  <a class="btn btn-link" style="color: black" href="{{ route('password.request') }}">
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
		          <form method="POST" action="{{ route('register') }}">
		            @csrf
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="text-left pb-3" style="border-bottom: 1px solid #e0cfc7ff">
		                  <label class="form-check-label" for="remember">
		                    NUEVO CLIENTE
		                  </label>
		                </div>
		              </div>
		            </div>
                <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="user" required autocomplete="name" autofocus>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>
		                @error('email')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password" style="border: 1px solid #e0cfc7ff" type="password" class="form-control @error('password') is-invalid @enderror input-pink" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
		                @error('password')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <input id="password-confirm" style="border: 1px solid #e0cfc7ff" type="password" class="form-control input-pink" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="d-flex">
		                  <input class="mr-2 checkbox-pink" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                  <label class="form-check-label" for="remember">
		                    Quiero suscribirme al newsletter
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6 offset-md-4">
		                <div class="d-flex">
		                  <input class="mr-2 checkbox-pink" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                  <label class="form-check-label" for="remember">
		                    Acepto los terminos y condiciones
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row mb-0">
		              <div class="col-md-6 offset-md-4 d-flex flex-column">
		                <button type="submit" class="btn button-pink">
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
		                <div class="text-left pb-3" style="border-bottom: 1px solid #e0cfc7ff">
		                  <label class="form-check-label" for="remember">
		                    CONTINUAR COMO INVITADO
		                  </label>
		                </div>
		              </div>
		            </div>
		            <div class="form-group row mb-0">
		              <div class="col-md-6 offset-md-4 d-flex flex-column">
		                <a type="submit" href="/" class="btn button-pink">
		                  CONTINUAR
		                </a>
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