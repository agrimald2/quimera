@extends('frontend.layout.layout')

@section('head')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Scripts -->
<script src="{{ asset('js/app.js?v=20210522') }}" defer></script>
<!-- Mercado Pago -->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<!-- Store css -->
<link href="{{ asset('assets/css/quimeraStore.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="app"></div>

<script>
/**
(function() {
		var ldk = document.createElement('script'); 
		ldk.type = 'text/javascript'; 
		ldk.async = true; 
		ldk.src = 'https://s.cliengo.com/weboptimizer/5f0f9cf43b6953002a3d4876/5f0f9d63e2f723002a86f995.js';
		var s = document.getElementsByTagName('script')[0]; 
		s.parentNode.insertBefore(ldk, s);
})(); */
</script>
<style>
/* #popupIframe, #chatIframe {
		float: left!important;
		right: auto!important;
		width: auto !important;
}

#popupIframe, #chatIframe > #pop-up-message {
		margin-right: 15rem;
} */
</style>
@endsection