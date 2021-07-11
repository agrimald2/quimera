<template>
  <div class="text-left px-4 lg:max-w-screen-lg mx-auto">
    <div class="border-b-2 border-red-100 py-4 font-bold px uppercase">
      Carrito de compras
    </div>

    <div class="border-b-2 border-red-100 flex">
      <div class="w-1/3 flex items-center justify-center">
        <img
          style="max-height: 250px"
          src="https://andreamx.vteximg.com.br/arquivos/ids/4522220-1000-1000/Perfil-Normal.jpg?v=637569525033800000"
          class="w-auto"
        />
      </div>
      <div
        class="
          md:flex-grow
          py-4
          flex flex-col
          md:items-center
          md:flex-row
          md:text-lg
          md:justify-between
          md:px-4
        "
      >
        <div class="font-bold grid md:grid-cols-2 gap-1 md:gap-5">
          <div class="">MARIA BOTS HUESO</div>
          <div class="">COLOR: NEGRO</div>
          <div class="">TALLA: 36</div>
          <div class="">CANTIDAD: 1</div>
          <div class="">PRECIO: S/. 459</div>
        </div>
        <div
          class="mt-3 flex items-center text-gray-800 gap-3 font-normal cursor-pointer hover:text-gray-500"
        >
          <div class="fas fa-trash"></div>
          Quitar
        </div>
      </div>
    </div>

    <div
      class="
        mt-4
        grid
        md:grid-cols-2
        lg:grid-cols-3
        gap-3
        lg:max-w-screen-lg
        mx-auto
      "
    >
      <div
        class="
          md:col-span-2
          lg:col-span-1
          border-2 border-red-100
          px-4
          py-4
          text-center
          font-bold
          uppercase
          cursor-pointer
          hover:bg-red-100
        "
      >
        ACTUALIZAR CARRITO
      </div>

      <div
        class="border-2 border-red-100 font-bold uppercase flex items-stretch"
      >
        <div
          class="
            flex-grow
            bg-red-100
            flex
            items-center
            justify-center
            hover:bg-red-200
            cursor-pointer
            px-3
          "
        >
          APLICAR
        </div>
        <input
          placeholder="Código de descuento "
          type="text"
          class="flex-grow px-4 uppercase"
        />
      </div>

      <div
        class="
          px-4
          py-4
          text-center
          font-bold
          uppercase
          cursor-pointer
          hover:bg-red-200
          bg-red-100
        "
      >
        COMPRAR
      </div>
    </div>
  </div>
</template>