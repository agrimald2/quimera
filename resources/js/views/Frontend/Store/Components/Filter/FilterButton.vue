<template>
<div class="border-b-2 border-red-100">
  
  <div class="name cursor-pointer uppercase bg-red-100 hover:bg-red-100 px-2 py-4">
    {{ name }}
  </div>
  
  <div class="items grid pt-4 pb-4">
    <slot />
  </div>

</div>
</template>


<script>
export default {
  props: {
    name: String,
  },

}
</script>