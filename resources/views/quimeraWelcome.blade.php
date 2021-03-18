@extends('quimeraLayouts.app')
@section('content')
    <div id="page">
        <div id="app" class="d-flex flex-column">
            <label class="text-center" for="card_name">Sometimes minimal, Sometimes Boho.. Always me.</label>
            <section class="brands" style="position: relative;">
                <div class="row d-flex justify-content-center" style="padding: 0 1em;">
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col">
                        <a href="/store/1"><img src="./assets/images/quimera/brandQuimera.png" style="width: 100%; height:100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col">
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
                <div class="d-flex flex-column typeScroll">
                    <label class="text-center keep-exp" for="card_name">SIGUE EXPLORANDO</label>
                    <div class="d-flex typeScrollHidden">
                        <div class="typeScrollImg" style=" background-color: white; margin-right: 10px">
                            <a href="/store/1" class="d-flex flex-column">
                                <img src="./assets/images/quimera/sneaker.png" style="padding: 5px;width: 100%">
                                <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px;color: black">Shoe Snickers</label>
                            </a>
                        </div>
                        <div class="typeScrollImg" style="background-color: white; margin-right: 10px">
                            <a href="/store/2" class="d-flex flex-column">
                                <img src="./assets/images/quimera/mules.png" style="padding: 5px;width: 100%">
                                <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px;color: black">Shoe Mules</label>
                            </a>
                        </div>
                        <div class="typeScrollImg" style="background-color: white; margin-right: 10px">
                            <a href="/store/4" class="d-flex flex-column">
                                <img src="./assets/images/quimera/boots.png" style="padding: 5px;width: 100%">
                                <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px; color: black">Shoe Snickers</label>
                            </a>
                        </div>
                        <div class="typeScrollImg" style=" background-color: white">
                            <a href="/store/5" class="d-flex flex-column">
                                <img src="./assets/images/quimera/flats.png" style="padding: 5px;width: 100%">
                                <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px; color: black">Shoe Snickers</label>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="new">
                <label class="text-left" for="card_name" style="font-size:16px; padding: 20px">New in store</label>
            </section>  
            <section class="carousel-brands d-flex justify-content-center flex-row" style="background-color: #e0cfc7ff">
                <div class="container">
                    <div class="row">
                        <div class="MultiCarousel" data-items="2,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
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
            <section class="join-us d-flex justified-content-center flex-column">
                <label class="text-center" for="card_name" style="padding: 20px; font-size: 16px">Se parte de nuestra comunidad en Instagram</label>
                <div class="d-flex">
                    <div class="w-100">
                        <img class="comunity-img-desk" src="./assets/images/quimera/info.png" style="width: 100%">
                        <img class="comunity-img-mobile" src="./assets/images/quimera/comunity.png" style="width: 100%">
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection