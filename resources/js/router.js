import VueRouter from 'vue-router';
import Vue from 'vue';
Vue.use(VueRouter)

import Index from "./pages/index";
import Login from "./pages/login";
import Register from "./pages/register";
import ForgotPassword from "./pages/forgot-password";
import ResetPassword from "./pages/reset-password";


const routes = [
    { path: '/', component: Index},
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/forgot-password', component: ForgotPassword },
    { path: '/password/reset/:token', component: ResetPassword }
  ];

  const router = new VueRouter({

    routes,
    hashbang:false,
    mode: "history",

  });

  router.beforeEach((to, from, next) => {
    let middleware = to.matched[0].components.default.middleware;
    if (middleware == "guest") {
      if (window.loggedIn) {

        next("/");
        return;
        
      }
      
    }
    if (middleware == "auth") {
      if (!window.loggedIn) {

        next("/login");
        return;
        
      }
      
      
    }
    // if(!window.loggedIn)
    // {
    //   if (to.path == "/") {
    //     next("/login");
    //     return;
    //   }
    // } else {
    //   if (to.path == "/login" || to.path == "/register") {
    //     next("/");
    //     return;
    //   }
    // }
    next();
  });

  export default router;