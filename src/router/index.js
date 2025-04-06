import { createRouter, createWebHistory } from "vue-router";
import loginApp from "@/components/login/loginApp.vue";
import allInventario from "@/components/inventary/allInventario";
import tareasList from "@/components/task/tareasList";

const routes = [
  {
    path: "/",
    name: "login",
    component: loginApp,
  },
  {
    path: "/inventary",
    name: "inventary",
    component: allInventario,
  },

  {
    path: "/main",
    name: "tareasList",
    component: tareasList,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
