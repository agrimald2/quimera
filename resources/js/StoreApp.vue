<template>
  <div id="app">
    <top-header/>
    <topbar/>
    <vue-snotify/>
    <div class="container-fluid">
      <router-view/>
    </div>
    <newsletter/>
    <bottom-footer/>
  </div>
</template>

<script>
import TopHeader from '@/components/HeaderQuimera'
import Topbar from '@/components/TopbarQuimera'
import Newsletter from '@/components/NewsletterQuimera'
import BottomFooter from '@/components/FooterQuimera'

export default {
  components: {
    TopHeader,
    Topbar,
    Newsletter,
    BottomFooter,
  },
  mounted() {

  }
}
</script>