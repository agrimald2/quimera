<template>
    <div class="col-12"> 
        <div class="card">
            <div class="card-header">
                <TabsVue></TabsVue>
            </div>
            <div class="card-body">
                <categories v-if="this.$route.path === '/categories'"></categories>
                <brands v-if="this.$route.path === '/brands'"></brands>
                <colors v-if="this.$route.path === '/colors'"></colors>
                <collections v-if="this.$route.path === '/collections'"></collections>
                <sizes v-if="this.$route.path === '/sizes'"></sizes>
            </div>
        </div>
        
    </div>
</template>

<script>
import TabsVue from "./Tabs";
import Categories from "../category/Categories";
import Brands from "../brand/Brands";
import Colors from "../color/Colors";
import Collections from "../collection/Collections";
import Sizes from "../size/Sizes";

export default{
   components:{
       TabsVue, 
       Categories, 
       Brands,
       Colors,
       Collections,
       Sizes
    },
}
</script>


      Collections