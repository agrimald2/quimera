<template>
  <section class="types">
    <div class="typesBg"></div>
    <div class="d-flex flex-column typeScroll">
      <label class="text-center keep-exp" for="card_name"
        >SIGUE EXPLORANDO</label
      >
      <div class="d-flex typeScrollHidden">
        <div
          class="typeScrollImg"
          style="background-color: white; margin-right: 10px; width: 24%"
          v-for="category in model"
          v-show="category.image_url"
          :key="category.id"
        >
          <a :href="`/store/${category.id }`" class="d-flex flex-column">
            <img
              :src="`/api/products/${category.image_url}`"
              style="padding: 5px; width: 100%"
            />
            
            <label
              class="text-center"
              for="card_name"
              style="margin-bottom: 0px; font-size: 18px; color: black"
              >{{ category.name }}</label
            >
          </a>
        </div>
      </div>
    </div>
  </section>
</template>


<script>
export default {
  props: ['model'],
}
</script>