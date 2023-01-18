/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * Vue filters
 */
Vue.filter('hoursBetweenDates', function (startDate, endDate) {
    let startTime = new Date(startDate);
    let endTime = new Date(endDate);
    let diff = endTime.getTime() - startTime.getTime();
    let diffInHours = diff / (1000 * 60 * 60);

    return `${diffInHours} hours`;
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('project', require('./components/Project.vue').default);
Vue.component('projects', require('./components/Projects.vue').default);


export const eventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
