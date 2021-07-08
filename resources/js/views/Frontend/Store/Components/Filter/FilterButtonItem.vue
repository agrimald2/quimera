<template>
  <div class="item py-2 pl-4 flex gap-4 hover:bg-gray-100 cursor-pointer">
    <div class="w-4 h-4 border" :class="{'bg-red-200': active}"></div>
    {{ name }}
  </div>
</template>


<script>
export default {
  props: {
    name: String,
    active: {
      type: Boolean,
      default: false,
    }
  }
}
</script>