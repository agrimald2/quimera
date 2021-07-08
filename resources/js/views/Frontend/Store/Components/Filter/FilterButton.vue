<template>
<div class="border-b-2 border-red-100 text-black">
  
  <div
    class="name cursor-pointer uppercase hover:bg-red-100 px-2 py-3"
    @click="visible = !visible"
    :class="{'bg-red-100': visible}"
    >
    {{ name }}
  </div>
  
  <div class="items grid py-2" :class="{ hidden: !visible}">
    <slot />
  </div>

</div>
</template>


<script>
export default {
  props: {
    name: String,
  },

  data(){
    return {
      visible: false,
    }
  }

}
</script>