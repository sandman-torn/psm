import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Dashboard from '@/views/Dashboard.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import exampleMiddleware from '@/middleware/exampleMiddleware';
import middlewarePipeline from './middlewarePipeline';
import redirectIfGuest from '@/middleware/redirectIfGuest';
import redirectIfAuthenticated from '@/middleware/redirectIfAuthenticated';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        middleware: [redirectIfGuest],
      },
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        middleware: [redirectIfAuthenticated],
      },
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      component: Login,
      meta: {
        middleware: [redirectIfAuthenticated],
      },
    },
  ],
});

router.beforeEach((to, from, next) => {
  // Check if the route has middleware
  if (!to.meta.middleware) {
    return next();
  }

  // get the middleware from the route
  const middleware = to.meta.middleware;
  const context = { to, from, next };
  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1),
  });
});

export default router;
