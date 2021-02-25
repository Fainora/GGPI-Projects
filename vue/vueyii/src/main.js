import Vue from 'vue'
import TestComponent from '@/components/TestComponent.vue'
import App from './App.vue'

window.Vue = Vue
window.Vue.component('test-component', TestComponent)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app') 
