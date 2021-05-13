<template>
    <div id="page">
    <div id="app" class="d-flex flex-column">
      <div class="pb-5 pt-5 pl-4 pr-4">
        <section class="d-flex flex-column" style="position: relative;">
          <label class="text-left store-title" for="card_name" style="margin-bottom: 0px;font-size: 18px">SHOP / BOOTS</label>
              <div class="row d-flex justify-content-center w-100">
                  <div class="pb-3 pt-3 pl-3 pr-3 col-md-5">
                      <img src="@/assets/img/quimera/boot-black.png" style="width: 100%; height:100%">
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
    </div>
  </div>
</template>

<script>
    export default {
        data(){
            return{

            }
        },
        created(){
            this.getData()
        },
        methods:{
            getData(){
                axios.get(`/product/${this.category_id}`).then(res => {
                    console.log('categories store', res);
                    this.categories = res.data.categories;
                })
            }
        }
    }
</script>