<template>
                <ul class="nav nav-tabs">
                    <li class="nav-item" style="margin:10px;">
                        <router-link :to="{ path: '/categories'}">
                            <a class="nav-link" :class="{ 'active' :  this.$route.path === '/categories'}">Categorias</a>
                        </router-link>                        
                    </li>
                    <li class="nav-item" style="margin:10px;">
                        <router-link :to="{ path: '/brands'}">
                            <a class="nav-link" :class="{ 'active' :  this.$route.path === '/brands'}" >Marcas</a>
                        </router-link>
                    </li>
                    <li class="nav-item" style="margin:10px;">
                        <router-link :to="{ path: '/colors'}">
                            <a class="nav-link" :class="{ 'active' :  this.$route.path === '/colors'}" >Colores</a>
                        </router-link>
                    </li>
                    <li class="nav-item" style="margin:10px;">
                        <router-link :to="{ path: '/collections'}">
                            <a class="nav-link" :class="{ 'active' :  this.$route.path === '/collections'}" >Colecciones</a>
                        </router-link>
                    </li>
                    <li class="nav-item" style="margin:10px;">
                        <router-link :to="{ path: '/sizes'}">
                            <a class="nav-link" :class="{ 'active' :  this.$route.path === '/sizes'}" >Tallas</a>
                        </router-link>
                    </li>
                </ul>
</template>