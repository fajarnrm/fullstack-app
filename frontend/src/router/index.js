import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Index from "../views/perencanaan-view/Index.vue";
import Create from "../views/perencanaan-view/Create.vue";
import Update from "../views/perencanaan-view/Update.vue";

const routes = [
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { isPublic: true },
  },

  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { isPublic: true },
  },

  {
    path: "/home",
    name: "Home",
    component: Home,
    meta: { requiresAuth: true },
  },
  {
    path: "/perencanaan",
    name: "Index",
    component: Index,
    meta: { requiresAuth: true },
  },
  {
    path: "/perencanaan/create",
    name: "Create",
    component: Create,
    meta: { requiresAuth: true },
  },
  {
    path: "/perencanaan/update/:id",
    name: "Update",
    component: Update,
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isPublic) {
    next({ name: "Home" });
  } else {
    next();
  }
});

export default router;
