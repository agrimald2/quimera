<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-21R7NFF8B9"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-21R7NFF8B9');
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Quimera</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <script src="https://kit.fontawesome.com/2e9575839f.js" crossorigin="anonymous"></script>

        <script src="./assets/js/functions.js"></script>
        <link href="./assets/css/quimeraStyles.css" rel="stylesheet">
    </head>
    <body>
    <div id="page">
        @include('quimeraLayouts.header')
        @include('quimeraLayouts.menu')
        <div id="app" class="d-flex flex-column">
            <label class="text-center" for="card_name">Sometimes minimal, Sometimes Boho.. Always me.</label>
            <section class="brands">
                <div class="row d-flex justify-content-center" style="padding: 0 1em;">
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col">
                        <a href="/store/1"><img src="./assets/images/categories1.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-4 pb-5 store_col">
                        <a href="/store/2"><img src="./assets/images/categories2.jpg" style="width: 100%"></a>
                    </div>
                </div>  
            </section>
            <section class="types">
                <div class="row d-flex" style="padding: 0 1em;">
                    <div class="col-xd-12 col-sm-6 col-lg-3 pb-5 store_col">
                        <a href="/store/1"><img src="./assets/images/categories1.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-3 pb-5 store_col">
                        <a href="/store/2"><img src="./assets/images/categories2.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-3 pb-5 store_col">
                        <a href="/store/4"><img src="./assets/images/categories4.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-3 pb-5 store_col">
                        <a href="/store/5"><img src="./assets/images/categories5.jpg" style="width: 100%"></a>
                    </div>
                </div>
            </section>
            <section class="carousel-brands d-flex justify-content-center flex-column">
                <label class="text-center" for="card_name">New in store</label>
                <div class="container">
                    <div class="row">
                        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                            <div class="MultiCarousel-inner">
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                       <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="pad15">
                                        <img src="./assets/images/categories5.jpg" style="width: 100%">
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
                <label class="text-center" for="card_name">Se parte de nuestra comunidad en Instagram</label>
                <div class="row d-flex" style="padding: 0 1em;">
                    <div class="col-xd-12 col-sm-6 col-lg-2 pb-5 store_col">
                        <a href="/store/1"><img src="./assets/images/categories1.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-2 pb-5 store_col">
                        <a href="/store/2"><img src="./assets/images/categories2.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-2 pb-5 store_col">
                        <a href="/store/4"><img src="./assets/images/categories4.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-2 pb-5 store_col">
                        <a href="/store/5"><img src="./assets/images/categories5.jpg" style="width: 100%"></a>
                    </div>
                    <div class="col-xd-12 col-sm-6 col-lg-2 pb-5 store_col">
                        <a href="/store/6"><img src="./assets/images/categories6.jpg" style="width: 100%"></a>
                    </div>
                </div>
            </section>
        </div>
        @include('quimeraLayouts.newsletter')
        @include('quimeraLayouts.footer')
    </div>
    </body>
</html>
<script type="text/javascript">
$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});
</script>