require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

//console.log('is running')

//Чтобы Vue использовал библиотеку VueRouter
Vue.use(VueRouter);

//Добавляется(регистрируется) комонент. Первый параметр 'home' - это имя компонента, второй - путь к файлу данного компонента
Vue.component('home', require('./components/Home.vue').default);

//let router = new VueRouter({});
//let router = new VueRouter({routes: routes});
//let router = new VueRouter({routes});  //или       	 //http://dav.crm/#/
let router = new VueRouter({ routes, mode: 'history' }); //Чтобы убрать решетку в пути. Теперь будет так: http://dav.crm/   http://dav.crm/users
const app = new Vue({ //const app - это новый экземляр Vue, который привязан к эл с айдишником app
    el: "#app",
	//router: router
    router
});