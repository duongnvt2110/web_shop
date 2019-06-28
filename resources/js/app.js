
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// home
Vue.component('nav-page',require('./components/NavPage.vue').default);

// product
Vue.component('show-product',require('./components/product/ShowProduct.vue').default);
Vue.component('create-product',require('./components/product/CreateProduct.vue').default);

//category
Vue.component('category',require('./components/category/Category.vue').default);

// user
Vue.component('user',require('./components/Admin/User.vue').default);
Vue.component('show-user',require('./components/user/ShowUser.vue').default);
Vue.component('cart',require('./components/Cart/Cart.vue').default);
Vue.component('admin-view-order',require('./components/Admin/AdminViewOrder.vue').default);
Vue.component('admin-view-activity',require('./components/Admin/AdminViewActivity.vue').default);
Vue.component('hover-cart',require('./components/Cart/HoverCart.vue').default);
//Home
Vue.component('home-product',require('./components/Home/HomeProduct.vue').default);

// support
Vue.component('flash',require('./components/Flash.vue').default);
Vue.component('paginate',require('./components/Paginate.vue').default);

import Vue from 'vue';
import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use( CKEditor );

const app = new Vue({
    el: '#app',
})
