<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="d-flex flex-column" style="position: relative;">
          <label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">SHOP / BOOTS</label>
              <div class="row d-flex justify-content-center w-100">
                  <div class="col-md-2 store-img-sec" style="padding-left: 0px">
                      <a class="pb-3 pt-3 pl-3 pr-3" href="/store/1"><img src="@/assets/img/quimera/boot-black-back.png" style="width: 100%%; height:100%"></a>
                      <a class="pb-3 pt-3 pl-3 pr-3" href="/store/2"><img src="@/assets/img/quimera/boot-black-horizontal.png" style="width: 100%%; height:100%"></a>
                      <a class="pb-3 pt-3 pl-3 pr-3" href="/store/2"><img src="@/assets/img/quimera/boot-black-front.png" style="width: 100%%; height:100%"></a>
                  </div>
                  <div class="pb-3 pt-3 pl-3 pr-3 col-md-5">
                      <a href="/store/2"><img src="@/assets/img/quimera/boot-black.png" style="width: 100%; height:100%"></a>
                  </div>
                  <div class="d-flex flex-column pb-3 pt-3 pl-3 pr-3 col-md-5" style="font-size: 12px">
                      <div class="d-flex flex-column pb-2 pt-2">
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">MARIA BOOTS HUESO</label>
                        <label class="text-left" for="card_name" style="margin-bottom: 0px;">S/. 469</label>
                    </div>
                    <div class="d-flex flex-column" style="border-top: 1px solid">
                        <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">COLOR</label>
                        <div class="d-flex">
                          <input type="checkbox"></input>
                        </div>
                        <label class="text-left pt-2" for="card_name" style="margin-bottom: 0px;">TALLA</label>
                        <div class="d-flex pb-2">
                          <input type="checkbox"></input>
                      </div>
                      <div class="d-flex pb-2 pt-2" style="border-top: 1px solid">
                          <label class="text-left" for="card_name" style="margin-bottom: 0px;">GUIA DE TALLAS</label>
                          <label class="text-right" for="card_name" style="margin-bottom: 0px;">ESTE PRODUCTO PERTENECE A LA TABLA A</label>
                      </div>
                      <div class="d-flex flex-column pb-2 pt-2 w-75">
                        <a type="submit" href="/shopping" class="btn button-pink w-100">
                        AGREGAR AL CARRITO
                        </a>
                      </div>
                      <div class="d-flex pb-2 pt-2">
                        <img src="@/assets/img/quimera/heart.png" class="mr-2 newsletter-img">
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
                                  <img src="@/assets/img/quimera/brownShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/brownUpperShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/brownShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/brownShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/brownUpperShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%">
                              </div>
                          </div>
                          <div class="item">
                              <div class="pad15">
                                  <img src="@/assets/img/quimera/brownUpperShoe.png" style="width: 100%">
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
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import CustomerModal from '@/components/CustomerModal'
import CheckoutModal from '@/components/CheckoutModal'

export default {
  components: {
    CustomerModal,
    CheckoutModal,
  },
  mounted() {
    var categoryId = this.$route.params.categoryId;
    this.category_id = categoryId;
    this.fetchData();
  },
  data() {
    return {
      disableds: [],
      products: [],
      categories: [],
      category_id: null,
      key: null,
      page: 0,
      itemsPerPage: 18,
      color: 0,
      talla: 0,
    }
  },
  computed: {
    ...mapGetters({
      sale: 'sale/getSale',
      products: 'sale/products',
      totalProducts: 'sale/totalProducts',
    }),
  },
  methods: {
    ...mapActions({
      removeAllProducts: 'sale/removeAllProducts',
      addProduct: 'sale/addProduct',
      plusProduct: 'sale/plusProduct',
      removeProduct: 'sale/removeProduct',
      setSale: 'sale/setSale',
      minusProduct: 'sale/minusProduct',
    }),
    checkDelivery() {
      $('#shoppingModal').modal('show');
    },
    removeP(product) {
      
    },
    plusP(product) {
      
    },
    minusP(product) {
      
    },
    successCheckout(data) {
      
    },
    errorCheckout(error) {
      console.log(data);
    },
    submit(sale) {
      
    },
    fetchData() {
      axios.get('categories').then(res => {
        console.log('categories store', res);
        this.categories = res.data.categories;
      });
      axios.get('shoppings').then(res => {
        console.log(res);
        this.removeAllProducts();
        var shoppings = res.data.shoppings;
        shoppings.forEach(item => {
          var product = item.product;
          console.log(product);
          if (product) {
            product.counter = item.counter;
            console.log(product);
            this.addProduct(product);
          }
        });
      });
      axios.get('disableds/shop').then(res => {
        console.log(res);
        this.disableds = res.data.disableds;
        axios.get('products/all').then(res => {
          console.log(res);
          this.products = res.data.products.filter(item => !this.disableds.find(e => e.product_id == item.id));
        });
      });
    },
  }
}
</script>
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

<style scoped>
  
</style>