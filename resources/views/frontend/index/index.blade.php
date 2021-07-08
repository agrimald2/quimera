@extends('frontend.layout.layout')


@section('content')
<div id="page">
    <div id="app" class="d-flex flex-column">
    <label class="text-center" for="card_name" style="font-family: 'Cedarville Cursive' ,cursive;font-size: 29px;">Sometimes minimal, Sometimes Boho.. Always me.</label>
        @include('frontend.index.components.brands')
        
        @include('frontend.index.components.types')

        <!-- @include('frontend.index.components.newInStore') -->
        
        <section class="join-us d-flex justified-content-center flex-column">
            <label class="text-center" for="card_name" style="padding: 20px;font-family: 'Cedarville Cursive' ,cursive;font-size: 27px;">Se parte de nuestra comunidad en Instagram</label>
            <div class="d-flex">
                <div class="w-100">
                    <img class="comunity-img-desk" src="./assets/images/quimera/info.png" style="width: 100%">
                    <img class="comunity-img-mobile" src="./assets/images/quimera/comunity.png" style="width: 100%">
                </div>
            </div>
        </section>
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

$(document).ready(function(){
    var count_storage = JSON.parse(localStorage.getItem('carts'));
    var count = count_storage.length;
    document.getElementById('count').innerHTML=count;
    console.log(count);
});

</script>


<style>

.btn-red{
    background: red;
}

.social{
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

