<template>
<div>
  <div
    class="py-1 px-4 inline-block uppercase font-bold cursor-pointer hover:bg-red-100"
    @click="visible = !visible"
    :class="{'bg-red-100': visible}">
    <i class="fas text-gray-800 mx-2"
      :class="{'fa-arrow-down': !visible, 'fa-arrow-up': visible}"></i>
    {{ name }}
  </div>
  <div class="mt-2" v-show="visible">
    <slot />
  </div>
</div>
</template>


<script>
export default {
  props: ['name'],
  
  data () {
    return {
      visible: false,
    }
  },

}
</script>