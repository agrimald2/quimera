<template>
  <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="d-flex" style="position: relative;">
          <div class="row store-flex">
            <div class="col-lg-2">
              <div class="sidebar d-md-block" style="text-align: start; padding: 0px 10px">
                <div class="sidebar-wrapper">
                  <div class="logo mb-4">
                    <a href="javascript:void(0)" style="color: black" class="simple-text logo-normal">
                      FILTRAR POR:  
                    </a>
                  </div>
                  <ul class="nav flex-column">
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navCategoria" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">CATEGORIA</a>
                        <ul class="collapse list-unstyled" id="navCategoria" style="padding-top: 10px;">
                          <li class="nav-item">
                            <a class="nav-link font-black" href="/">active</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navTalla" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">TALLA</a>
                        <ul class="collapse list-unstyled" id="navTalla" style="padding-top: 10px;">
                          <li class="nav-item">
                            <a class="nav-link font-black" href="/">active</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navColor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">COLOR</a>
                        <ul class="collapse list-unstyled" id="navColor" style="padding-top: 10px;">
                          <li class="nav-item">
                            <a class="nav-link font-black" href="/">active</a>
                          </li>
                      </ul>
                    </li>
                    <li class="nav-item" style="padding: 10px 0px;">
                      <a href="#navColeccion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sidebar-button" style="border-bottom: 1px solid #e0cfc7;padding-bottom: 10px;color: black">COLECCION</a>
                        <ul class="collapse list-unstyled" id="navColeccion" style="padding-top: 10px;">
                          <li class="nav-item">
                            <a class="nav-link font-black" href="/">active</a>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
             </div> 
            <div class="col-lg-10 d-flex" style="flex-wrap: wrap;">
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
                </div>
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
                </div>
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
                </div>
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
                </div>
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
                </div>
                <div class="col-lg-4" style="padding-bottom: 15px;">
                  <div class="d-flex flex-column" style="align-items: center;">
                    <img src="@/assets/img/quimera/blackShoe.png" style="width: 100%;border: 1px solid #e0cfc7ff;">
                    <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 14px; padding:5px">Shoe</label>
                  </div>
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
      boolean: false,
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