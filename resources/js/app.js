//All imports
import VueRouter from 'vue-router';
import store from './store';
import Swal from 'sweetalert2'
// import App from './App.vue';
import routes from './routes';
import VueHtmlToPaper from 'vue-html-to-paper';
import VueFormWizard from 'vue-form-wizard'
import VueConfetti from 'vue-confetti'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import PerfectScrollbar from 'vue2-perfect-scrollbar'
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css'
import vmodal from 'vue-js-modal'
import NProgress from 'vue-nprogress'
import NProgressContainer from 'vue-nprogress/src/NprogressContainer'
import VuePageTransition from 'vue-page-transition'
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
window.Vue = require('vue');
window.moment = require('moment');
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
})

const npoptions = {
  router : true,
  http: false
}
require('./bootstrap');
window.toast = toast;

//laravel-vue-pagination
Vue.component('pagination', require('laravel-vue-pagination'))

//All Components
Vue.component('research-list', require('./components/ResearchList.vue').default);
Vue.component('admin-sidebar', require('./pages/admin/AdminSidebar.vue').default);
Vue.component('nprogress-container', NProgressContainer);
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue').default);
Vue.component('moon-loader', require('vue-spinner/src/MoonLoader.vue').default);
//All Vue Use
Vue.use(PerfectScrollbar);
Vue.use(VueRouter);
Vue.use(VueFormWizard);
Vue.use(VueConfetti);
Vue.use(vmodal);
Vue.use(NProgress, npoptions);
Vue.use(require('vue-moment'));
Vue.use(VuePageTransition)

const nprogress = new NProgress()
nprogress.configure({easing: 'ease', speed:400})

const options = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=yes'
    ],
    styles: [
      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    ]
  }
Vue.use(VueHtmlToPaper, options);

const router = new VueRouter({
    mode: 'history',
    routes,
  
});

router.beforeResolve((to, from ,next) => {
  if(to.name) {
    nprogress.start()
  }
  next()
})

router.afterEach((to,from) => {
  nprogress.done()
})
new Vue({
    store,
    router,
    // render: h => h(App)
}).$mount('#app');
