require('./bootstrap');

import Vue from 'vue';
import store from '~/stores';
import {App, plugin} from '@inertiajs/inertia-vue'
import {InertiaProgress} from "@inertiajs/progress";
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import ArgonDashboard from './plugins/argon-dashboard'
import Gravatar from 'vue-gravatar';

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(plugin)
Vue.use(ArgonDashboard)
Vue.component('v-gravatar', Gravatar);


Vue.prototype.$route = route;
const el = document.getElementById('app')

new Vue({
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => import(/* webpackChunkName: '[request]' */ `./pages/${name}`).then(module => module.default),
    },
  }),
  store
}).$mount(el)

InertiaProgress.init({
  color: '#1299da',
});
