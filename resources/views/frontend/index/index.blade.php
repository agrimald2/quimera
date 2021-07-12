@extends('frontend.layout.layout')

@section('head')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Mercado Pago -->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
@endsection


@section('content')
<div id="app"></div>
<script src="{{ mix('js/app.js') }}"></script>
@endsection