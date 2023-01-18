/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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


import moment from 'moment'
Vue.filter('timeBetween', function(start, end) {
  if (start && end) {
    return moment.utc(moment(end).diff(moment(start))).format("HH:mm:ss")
  }
})

Vue.filter('totalTime', function(items) {
    let totalTime = 0;
    items.forEach(item => {
      let itemStart = moment(item.start);
      let itemEnd = moment(item.end);
        totalTime += itemEnd.diff(itemStart, 'hours');
    });

    return totalTime + " hours";
});

export const eventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
