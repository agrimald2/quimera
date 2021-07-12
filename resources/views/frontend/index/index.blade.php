@extends('frontend.layout.layout')

@section('head')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js?v=20210522') }}" defer></script>

<!-- Mercado Pago -->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
@endsection


@section('content')
<div id="app"></div>
@endsection