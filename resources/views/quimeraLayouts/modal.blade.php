<div class="modal-header">
    <h4 class="modal-title" id="default-info">INFO CLIENTE</h4>
    <h4 class="modal-title" id="first-info">ENVIO</h4>
    <h4 class="modal-title" id="second-info">PAGO</h4>
</div>
<div class="modal-body" id="default" style="padding: 3rem !important">
    <form method="POST" action="{{ route('login') }}">
    @csrf
    	<div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="NOMBRE Y APELLIDO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="CORREO ELECTRONICO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group d-flex">
          	<div class="col-md-6" style="padding-left: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="PAIS" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
          	<div class="col-md-6" style="padding-right: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="TELEFONO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="PROVINCIA / ESTADO / REGION" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="DISTRICTO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="DIRECCION" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="INTERIOR" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="REFEENCIA" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group d-flex">
          	<div class="col-md-6" style="padding-left: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="TIPO DE DOCUMENTO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
          	<div class="col-md-6" style="padding-right: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="NRO DOCUMENTO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="FECHA DE NACIMIENTO" autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
</div>
<div class="modal-body-address" id="first" style="padding: 3rem !important">
    <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="form-group row">
          	<div class="col-md-12">
          		<button type="button" class="btn btn-primary w-100" style="background-color:white;border:1px solid #e0cfc7ff; color:black">ENVIO REGULAR - GRATIS (PERU)</button>
	            <label id="email" type="email" class="mt-2">
	            	*24 a 48 hrs Lima Metropolitana
	            </label>
	            <label id="email" type="email" class="mt-2">
	            	*48 a 72 hrs Provincias
	            </label>
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <button type="button" style="background-color: #e0cfc7ff; color: black; border:none" class="btn btn-primary mt-2 w-100" color: black; border:none">ENVIO EXPRESS (S/.20)</button>
	            <label id="email" type="email" class="mt-2">
	            	*Miraflores / San Isidro / Magdalena / Lince / Surco
					Jesus Maria / San Borja / Brena / San Borja /
					Barranco / San Miguel / Surquillo
	            </label>
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <button type="button" class="btn btn-primary mt-2 w-100" style="background-color:white;border:1px solid #e0cfc7ff; color:black">RECOJO EN TIENDA ( GRATIS)</button>
          	</div>
        </div>
    </form>
</div>
<div class="modal-body-payment" id="second" style="padding: 3rem !important">
    <form method="POST" action="{{ route('login') }}">
    @csrf
    	<div class="form-group row" style="text-align: left;">
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" style="margin-top: 3px" for="remember">
                TARJETAS DEBITO / CREDITO (MERCADO PAGO) *6 cuotas sin interes con Diners
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row" style="text-align: left;">
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" style="margin-top: 3px" for="remember">
                PAGO EFECTIVO
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row" style="text-align: left;">
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" style="margin-top: 3px" for="remember">
                YAPE
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row" style="text-align: left;">
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" style="margin-top: 3px" for="remember">
                TRANSFERENCIA
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row" style="text-align: left;">
          <div class="col-md-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" style="margin-top: 3px" for="remember">
                *ESTOY DE ACUERDO CON LOS TERMINOS Y CONDICIONES
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <button type="button" class="btn btn-primary w-100" style="background-color: #e0cfc7ff; color: black; border:none">Pagar</button>
          	</div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" id="enviar" class="btn btn-primary" style="background-color: #e0cfc7ff; color: black; border:none">Continuar</button>
    <button type="button" id="enviarFirst" class="btn btn-primary" style="background-color: #e0cfc7ff; color: black; border:none">Continuar</button>
    <button type="submit" id="enviarSecond" class="btn btn-primary" style="background-color: #e0cfc7ff; color: black; border:none">Continuar</button>
</div>
<script type="text/javascript">
	$('#first').hide(); //muestro mediante id
			$('#second').hide();
			$('#first').hide();
			$('#first-info').hide();
			$('#second-info').hide();
			$('#enviarFirst').hide();
			$('#enviarSecond').hide();
	$(document).ready(function(){
		$("#enviar").on( "click", function() {
			$('#first').show(); //muestro mediante id
			$('#first-info').show();
			$('#second-info').hide();
			$('#default-info').hide();
			$('#second').hide();
			$('#default').hide(); //muestro mediante clase
			$('#enviarFirst').show();
			$('#enviarSecond').hide();
			$('#enviar').hide();
		 });
		$("#enviarFirst").on( "click", function() {
			$('#first').hide(); //muestro mediante id
			$('#second').show();
			$('#second-info').show();
			$('#first-info').hide();
			$('#default-info').hide();
			$('#default').hide(); //muestro mediante clase
			$('#enviarFirst').hide();
			$('#enviarSecond').show();
			$('#enviar').hide();
		});
		$("#enviarSecond").on( "click", function() {
			$('#first').hide(); //muestro mediante id
			$('#second').hide();
			$('#first-info').hide();
			$('#second-info').hide();
			$('#default-info').show();
			$('#default').show(); //muestro mediante clase
			$('#enviarFirst').hide();
			$('#enviarSecond').hide();
			$('#enviar').show();
		});
	});
</script>	