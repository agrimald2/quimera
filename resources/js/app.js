require('./bootstrap');

import Vue from 'vue'


/**
 * Global components
 */
import VueFeather from 'vue-feather'
Vue.component(VueFeather.name, VueFeather);

import PageNavigation from '@/components/PageNavigation'
Vue.component('page-navigation', PageNavigation);

import Datepicker from '@/components/Datepicker'
Vue.component('datepicker', Datepicker);

import ToggleButton from '@/components/ToggleButton'
Vue.component('toggle-button', ToggleButton);

// Custom
import QuimeraProduct from './views/quimerastore/product.vue'
Vue.component('quimera-product', QuimeraProduct.default);


/**
 * Plugins
 */
import VueLoading from 'vuejs-loading-plugin'
import excel from 'vue-excel-export'
Vue.use(VueLoading, excel);

import Snotify from 'vue-snotify'
Vue.use(Snotify, { toast: { timeout: 4000 } });

import moment from 'moment-timezone'
import VueMoment from 'vue-moment'
Vue.use(VueMoment, {moment})


Vue.prototype.$eventHub = new Vue();


/**
 * Custom mixin's
 */
Vue.mixin({
    data() {
        return {
            unitCodes: [
                { unitCode: 'KGM', name: 'KILOGRAMOS' },
                { unitCode: 'NIU', name: 'UNIDADES' },
                { unitCode: 'BG', name: 'BOLSAS' },
                { unitCode: 'BO', name: 'BOTELLAS' },
                { unitCode: 'BX', name: 'CAJAS' },
                { unitCode: 'PK', name: 'PAQUETES' },
            ],
        }
    },
    methods: {
        checkInventory(product) {
            var totalOne = 0;
            var totalCollectionOne = [];
            var totalTwo = 0;
            var totalCollectionTwo = [];

            if (product.picked.length) {
                return product.picked;
            }

            for (const inventory of product.inventory) {
                if (product.counter % inventory.weight) {
                    continue;
                }
                if (product.counter >= (totalOne + inventory.weight)) {
                    totalOne += inventory.weight;
                    totalCollectionOne.push(inventory);
                }
            }

            for (const inventory of product.inventory) {
                if (product.counter >= (totalTwo + inventory.weight)) {
                    totalTwo += inventory.weight;
                    totalCollectionTwo.push(inventory);
                }
            }

            var minOne = product.counter - totalOne;
            var minTwo = product.counter - totalTwo;

            if (minOne < minTwo) {
                if (!totalCollectionOne.length && product.inventory.length) {
                    totalCollectionOne.push(product.inventory.slice(-1)[0]);
                    return totalCollectionOne;
                } else {
                    return totalCollectionOne;
                }
            } else {
                if (!totalCollectionTwo.length && product.inventory.length) {
                    totalCollectionTwo.push(product.inventory.slice(-1)[0]);
                    return totalCollectionTwo;
                } else {
                    return totalCollectionTwo;
                }
            }
        },
        formatCode(code) {
            var string = '' + code;
            switch (string.length) {
                case 1:
                    return `00000${code}`;
                case 2:
                    return `0000${code}`;
                case 3:
                    return `000${code}`;
                case 4:
                    return `00${code}`;
                case 5:
                    return `0${code}`;
                case 6:
                    return `${code}`;
            }
        },
        formatTime(date) {
            date = new Date(date);
            var ampm = 'AM';
            var hours = date.getHours();
            var minutes = date.getMinutes();
            if (hours >= 12) {
                ampm = 'PM';
            }
            if (hours >= 13) {
                hours -= 12;
            }
            // Formatear 2 dijitos
            if (hours < 10) {
                hours = `0${hours}`;
            }
            if (minutes < 10) {
                minutes = `0${minutes}`;
            }
            return `${hours} : ${minutes} ${ampm}`;
        },
        formatDate(date) {
            moment.locale('es');
            var d = moment(date);
            return d.tz('America/Lima').format('ll')
        },
    }
});


import App from './App.vue'

import StoreApp from './StoreApp'
import store from './store'

import router from './router'

const app = new Vue({
    router,
    store,
    render: function(renderElement) {
        if (
        this.$route.path.includes('/item')
        || this.$route.path.includes('/store') 
        || this.$route.path == '/cart' 
        || this.$route.path == '/payment' 
        || this.$route.path == '/shopping' 
        || this.$route.path.includes('/checkout')
        ) {
            return renderElement(StoreApp);
        } else {
            return renderElement(App);
        }
    },
});

app.$mount('#app');
