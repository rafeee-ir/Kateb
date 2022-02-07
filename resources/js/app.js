/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const Task = require("./components/project/Tasks");

window.Vue = require('vue').default;

Vue.directive('can', function (el, binding, vnode) {

    if(Permissions.indexOf(binding.value) !== -1){
        return vnode.elm.hidden = false;
    }else{
        return vnode.elm.hidden = true;
    }
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('check-online', require('./components/CheckOnline').default);
Vue.component('tasks', require('./components/project/Tasks.vue').default);
Vue.component('tickets', require('./components/tickets/Tickets.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// import { createApp } from 'vue'
// import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
// import App from './components/App.vue'
// const app = createApp(App)
// app.use(LaravelPermissionToVueJS)
// app.mount('#app')

const app = new Vue({
    el: '#app',
});
