<div class="modal-header">
    <h4 class="modal-title">INFO CLIENTE</h4>
</div>
<div class="modal-body" style="padding: 3rem !important">
    <form method="POST" action="{{ route('login') }}">
    @csrf
    	<div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="NOMBRE Y APELLIDO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="CORREO ELECTRONICO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group d-flex">
          	<div class="col-md-6" style="padding-left: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="PAIS" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
          	<div class="col-md-6" style="padding-right: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="TELEFONO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="PROVINCIA / ESTADO / REGION" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="DISTRICTO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="DIRECCION" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="INTERIOR" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="REFEENCIA" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group d-flex">
          	<div class="col-md-6" style="padding-left: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="TIPO DE DOCUMENTO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
          	<div class="col-md-6" style="padding-right: 0px !important">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="NRO DOCUMENTO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
        <div class="form-group row">
          	<div class="col-md-12">
	            <input id="email" type="email" style="border: 1px solid #e0cfc7ff" class="form-control @error('email') is-invalid @enderror input-pink" name="email" value="{{ old('email') }}" placeholder="FECHA DE NACIMIENTO" required autocomplete="email" autofocus>
	            @error('email')
	              <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	              </span>
	            @enderror
          	</div>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary" style="background-color: #e0cfc7ff; color: black; border:none">Continuar</button>
</div>