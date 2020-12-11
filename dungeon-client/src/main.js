import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import axios from './plugins/axios'
import Pagination from 'vue-paginate-al'
import Loading from 'vue-loading-overlay';

import 'material-icons/iconfont/material-icons.scss';
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import 'vue-loading-overlay/dist/vue-loading.css';

import Demonic from './components/demo/Demonic';

import HeroList from './components/hero/list.vue'
import HeroCreate from './components/hero/create.vue'
import HeroUpdate from './components/hero/update.vue'

import PlaceList from './components/place/list.vue'
import PlaceCreate from './components/place/create.vue'
import PlaceUpdate from './components/place/update.vue'
import PlaceDisplay from './components/place/display.vue'

import RouteList from './components/route/list.vue'
import RouteCreate from './components/route/create.vue'
import RouteUpdate from './components/route/update.vue'

import CategoryList from './components/category/list.vue'
import CategoryCreate from './components/category/create.vue'
import CategoryUpdate from './components/category/update.vue'
// Import stylesheet

Vue.config.productionTip = false;

// Init plugin
Vue.use(VueRouter);
Vue.use(axios);
Vue.use(Loading);
Vue.use(VueMaterial);
Vue.component('pagination', Pagination);

Vue.axios.defaults.baseURL = `http://${process.env.VUE_APP_ENV_HOST}:${process.env.VUE_APP_ENV_PORT}`;

const routes = [
  { path: '/demo', component: Demonic },
  { path: '/app', component: App },
  { path: '/hero/list', component: HeroList },
  { path: '/hero/create', component: HeroCreate },
  { path: '/hero/update/:id', component: HeroUpdate },
  { path: '/place/list', component: PlaceList },
  { path: '/place/create', component: PlaceCreate },
  { path: '/place/update/:id', component: PlaceUpdate },
  { path: '/place/display/:id', component: PlaceDisplay },
  { path: '/route/list', component: RouteList },
  { path: '/route/create', component: RouteCreate},
  { path: '/route/update/:id', component: RouteUpdate},
  { path: '/category/list', component: CategoryList },
  { path: '/category/create', component: CategoryCreate },
  { path: '/category/update', component: CategoryUpdate },
  { path: '/', component: App },
];

const router = new VueRouter({
  mode: 'history',
  routes
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app');
