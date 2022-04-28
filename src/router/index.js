import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import AddStudentView from "../views/AddStudentView.vue";
import LoginView from "../views/LoginView.vue";
import StudentsListView from "../views/StudentsListView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  },
  {
    path: '/addStudent',
    name: 'addStudent',
    component: AddStudentView,
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  },
  {
    path: '/studentsList',
    name: 'studentList',
    component: StudentsListView,
  },
];

const router = new VueRouter({
  routes
});

export default router;
