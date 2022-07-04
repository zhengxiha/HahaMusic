// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Vuex from 'vuex'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import App from './App'
import router from './router'
import store from './store'

//引入阿里图标
import './assets/iconfont/iconfont.css'
import './assets/iconfont/iconfont.js'

Vue.use(Vuex)
Vue.use(ElementUI)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store: new Vuex.Store(store),
    // components: { App },
    // template: '<App/>'
    render: h => h(App)
})