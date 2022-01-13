//require("./bootstrap");
import axios from "axios";
import Vue from 'vue'

//Import v-from
window.axios = axios

//component
Vue.component(
    "product-component",
    require("./components/ProductList.vue").default
);

Vue.component(
    "cart-component",
    require("./components/CartList.vue").default
);

const app = new Vue({
    el: "#app",
});
