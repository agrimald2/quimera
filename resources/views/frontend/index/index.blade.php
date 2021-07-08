@extends('frontend.layout.layout')


@section('content')
<div>
  <div class="d-flex flex-column">
    <label class="text-center" for="card_name" style="font-family: 'Cedarville Cursive' ,cursive;font-size: 29px;">Sometimes minimal, Sometimes Boho.. Always me.</label>
    
    @include('frontend.index.components.brands')

    @include('frontend.index.components.types')

    @include('frontend.index.components.newInStore')

    @include('frontend.index.components.instagram')
  </div>
</div>

<div class="social">
  <a class="shopcart-icon" href="/cart">
    <img src="./assets/images/quimera/car.png" style="width: 100%">
    <span class="count">
      <p><label id="count"></label> </p>
    </span>
  </a>
</div>


<script>
  $(document).ready(function() {
    var count_storage = JSON.parse(localStorage.getItem('carts'));
    var count = count_storage.length;
    document.getElementById('count').innerHTML = count;
    console.log(count);
  });
</script>


<style>
  .btn-red {
    background: red;
  }

  .social {
    color: #f3ecec;
    width: 56px;
    padding: 14px;
    margin: 10px;
    position: fixed;
    top: 277px;
    right: -15px;
    background: #e0d4d4;
    border-radius: 10px;
    z-index: 1000;
  }

  .social .shopcart-icon {
    font-size: 15px;
    position: relative;
    text-transform: uppercase;
    line-height: 6px;
    color: #191717;
    padding-top: 13px;
  }

  .social .count {
    position: absolute;
    display: inline-block;
    text-align: center;
    width: 37px;
    height: 19px;
    border-radius: 50%;
    top: -3px;
    right: -1px;
    color: #ffffff;
    font-size: 17px;
    line-height: 22px;
  }
</style>
@endsection