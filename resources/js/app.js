require('./bootstrap');

import Vue from 'vue';

//console.log('is running')

//Добавляется(регистрируется) комонент. Первый параметр 'home' - это имя компонента, второй - путь к файлу данного компонента
Vue.component('home', require('./components/Home.vue').default);

const app = new Vue({
    el: "#app"
});