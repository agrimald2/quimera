@extends('quimeraLayouts.app')
@section('content')
    <div id="page">
        <div id="app" class="d-flex flex-column">
        	<div class="pb-5 pt-5 pl-4 pr-4">
	        	<section class="d-flex flex-column" style="position: relative;">
	        		<label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">SHOP / BOOTS</label>
	                <div class="row d-flex justify-content-center w-100">
	                    <div class="col-md-2 store-img-sec">
	                        <a class="pb-3 pt-3 pl-3 pr-3" href="/store/1"><img src="./assets/images/quimera/boot-black-back.png" style="width: 100%%; height:100%"></a>
	                        <a class="pb-3 pt-3 pl-3 pr-3" href="/store/2"><img src="./assets/images/quimera/boot-black-horizontal.png" style="width: 100%%; height:100%"></a>
	                        <a class="pb-3 pt-3 pl-3 pr-3" href="/store/2"><img src="./assets/images/quimera/boot-black-front.png" style="width: 100%%; height:100%"></a>
	                    </div>
	                    <div class="pb-3 pt-3 pl-3 pr-3 col-md-5">
	                        <a href="/store/2"><img src="./assets/images/quimera/boot-black.png" style="width: 100%; height:100%"></a>
	                    </div>
	                    <div class="d-flex flex-column pb-3 pt-3 pl-3 pr-3 col-md-5" style="font-size: 12px">
	                        <div class="d-flex flex-column pb-2 pt-2">
	                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">MARIA BOOTS HUESO</label>
	                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">S/. 469</label>
	                    	</div>
	                    	<div class="d-flex flex-column" style="border-top: 1px solid">
	                        	<label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">COLOR</label>
	                        	<div class="d-flex">
	                        		<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        		</div>
                        		<label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">TALLA</label>
                        		<div class="d-flex pb-2">
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        			<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    			</div>
		                    	<div class="d-flex pb-2 pt-2" style="border-top: 1px solid">
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">GUIA DE TALLAS</label>
		                        	<label class="text-right" for="card_name" style="margin-bottom: 0px;">ESTE PRODUCTO PERTENECE A LA TABLA A</label>
		                    	</div>
		                    	<div class="d-flex flex-column pb-2 pt-2 w-75">
		                        	<button type="submit" class="btn button-pink w-100">
					                  	AGREGAR AL CARRITO
					                </button>
		                    	</div>
		                    	<div class="d-flex pb-2 pt-2">
		                    		<img src="./assets/images/quimera/heart.png" class="mr-2 newsletter-img">
		                    		<label class="text-left" for="card_name" style="margin-bottom: 0px;">WISHLIST</label>
		                    	</div>
		                    	<div class="d-flex flex-column pb-2 pt-2">
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">DESCRIPCION</label>
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">DETALLES Y MATERIALES</label>
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">ENVIOS</label>
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">CAMBIOS Y DEVOLUCIONES</label>
		                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">LIMPIEZA Y CUIDADO</label>
		                    	</div>
	                    	</div>
	                    </div> 
	                </div> 
	            </section>
            </div>
        	<div class="pb-5 pt-5 pl-4 pr-4 d-flex flex-column">
        		<label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">NUESTRAS SUGERENCIAS PARA TI</label>
				<section class="carousel-brands d-flex justify-content-center flex-row" style="background-color: #e0cfc7ff">
				                <div class="container">
				                    <div class="row">
				                        <div class="MultiCarousel" data-items="2,3,4,5" data-slide="1" id="MultiCarousel"  data-interval="1000">
				                            <div class="MultiCarousel-inner">
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownUpperShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/blackShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownUpperShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/blackShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                                <div class="item">
				                                    <div class="pad15">
				                                        <img src="./assets/images/quimera/brownUpperShoe.png" style="width: 100%">
				                                    </div>
				                                </div>
				                            </div>
				                            <button class="btn btn-primary leftLst"><</button>
				                            <button class="btn btn-primary rightLst">></button>
				                        </div>
				                    </div>
				                </div>  
				</section>
			</div>
		</div>
	</div>
@endsection