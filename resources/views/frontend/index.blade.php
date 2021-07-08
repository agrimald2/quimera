@extends('frontend.layout.layout')


@section('content')
<div id="page">
        <div id="app" class="d-flex flex-column">
        <label class="text-center" for="card_name" style="font-family: 'Cedarville Cursive' ,cursive;font-size: 29px;">Sometimes minimal, Sometimes Boho.. Always me.</label>
            <section class="brands" style="position: relative;">
                <div class="row d-flex justify-content-center" style="padding: 0 1em;">
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col" id="img-shop">
                        <a href="/store/1"><img src="./assets/images/quimera/brandQuimera.png" style="width: 100%; height:100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col" id="img-nomada">
                        <a href="/store/2"><img src="./assets/images/quimera/brandNomada.png" style="width: 100%; height:100%"></a>
                    </div>
                </div>
                <div class="firstBrand">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px">SHOP Quimera</label>
                </div>  
                <div class="secondBrand">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px">SHOP Nomada</label>
                </div>
                <div class="firstBrandLogo">
                    <img src="./assets/images/quimera/userPink.png">
                </div>  
                <div class="secondBrandLogo">
                    <img src="./assets/images/quimera/carPink.png">
                </div>
            </section>
            <section class="types">
                <div class="typesBg"></div>
                <div class="d-flex flex-column typeScroll">
                    <label class="text-center keep-exp" for="card_name">SIGUE EXPLORANDO</label>
                    <div class="d-flex typeScrollHidden">
                        @forelse ($categories as $row)
                            <div class="typeScrollImg" style=" background-color: white; margin-right: 10px,; width: 24%;">
                                <a href="/store/{{$row['id']}}" class="d-flex flex-column">
                                    @if ($row['image_url'] != null)
                                        <img src="/api/products/{{$row['image_url']}}" style="padding: 5px;width: 100%">
                                    @else
                                        <img src="./assets/images/quimera/mules.png" style="padding: 5px;width: 100%">
                                    @endif
                                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px;color: black">{{$row['name']}}</label>
                                </a>
                            </div>
                        @empty
                            
                        @endforelse
                        
                    </div>
                </div>
            </section>
            <section class="new">
                <label class="text-left" for="card_name" style="font-family: 'Cedarville Cursive' ,cursive;font-size: 46px; margin-top: 148px;">New in store</label>
            </section>  
            <section class="carousel-brands d-flex justify-content-center flex-row" style="background-color: #e0cfc7ff;margin-top: -100px;">
                <div class="container">
                    <div class="row">
                        <div class="MultiCarousel" data-items="2,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                            <div class="MultiCarousel-inner">
                                @forelse ($products as $row)
                                    <div class="item">
                                        <a href="/item/{{$row['id']}}">
                                        <div class="pad15" style="background: #fff !important;left: 48px !important;float: left;position: relative;">
                                            <img src="/api/products/{{$row['image_url']}}" style="width: 100%">
                                        </div>
                                        </a>
                                    </div>
                                @empty
                                    
                                @endforelse
                                
                            </div>
                            <button class="btn btn-primary leftLst" style="background: transparent !important; border-color:transparent !important;">
                                <i class="fa fa-caret-left fa-3x" style="color: #946f5e !important;"></i>
                            </button>
                            <button class="btn btn-primary rightLst" style="background: transparent !important; border-color:transparent !important;">
                                <i class="fa fa-caret-right fa-3x" style="color: #946f5e !important;"></i>
                            </button>
                        </div>
                    </div>
                </div>  
            </section>
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

