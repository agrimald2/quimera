@extends('quimeraLayouts.app')
@section('content')
    <div id="page">
        <div id="app" class="d-flex flex-column">
        	<div class="pb-5 pt-5 pl-4 pr-4 d-flex justify-content-center">
	        	<section class="col-lg-6 d-flex flex-column text-center" style="position: relative;">
	        		<label class="text-left w-100 mb-2" for="card_name" style="margin-bottom: 0px;font-size: 18px; border-bottom: 1px solid #e0cfc7ff;">SHOP / BOOTS</label>
	                <div class="row d-flex w-100 mt-4 mb-4" style="align-items: center;">
                        <a class="col-lg-6 d-flex justify-content-end w-50" href="/store/1"><img src="./assets/images/quimera/boot-black-back.png" class="" style="width: 100%; height:100%"></a>
                        <div class="col-lg-6 d-flex flex-column pl-4 w-50 shopping-font-details">
                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">MARIA BOOTS HUESO</label>
                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">COLOR: Negro</label>
                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">TALLA: 36</label>
                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">CANTIDAD: 1</label>
                        	<label class="text-left" for="card_name" style="margin-bottom: 0px;">PRECIO: S/.459</label>
                        	<a class="d-flex mt-2" style="align-content: flex-start;" href="/shopping"><i class="fa fa-trash"></i></a>
                    	</div>
	                </div>
	                <div class="d-flex flex-column align-items-center w-100"
	                style="align-self: center; border-top: 1px solid #e0cfc7ff; padding: 40px 0px">
                        <button type="submit" class="btn button-pink shopping-button-size" style="background:white;padding: 5px; border: 1px solid #e0cfc7ff;">
		                  ACTUALIZAR CARRITO
		                </button>
                        <div class="d-flex justify-content-center mt-2 mb-4 shopping-button-size" style="padding: 0px !important">
		                    <div class="newsletterForm w-25" style="background:#e0cfc7ff;color:black;padding: 5px">
		                      <label style="margin: 0px;">APLICAR</label>
		                    </div>
		                    <input style="border:1px solid #e0cfc7ff;padding: 5px" class="w-75" type="text" id="search" name="search" placeholder="CODIGO DESCUENTO">
		                </div> 
                    	<a data-toggle="modal" type="submit" data-target="#myModal" class="button-pink shopping-button-size" style="padding: 5px">
		                  COMPRAR
		                </a>
	                </div> 
	            </section>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			        	@include('quimeraLayouts.modal')
			        </div>
			    </div>
			</div>
		</div>
	</div>
@endsection
