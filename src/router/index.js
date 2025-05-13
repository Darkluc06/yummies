import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue'; 
import DetailPage from '../views/recipes/detailPage.vue';
import Documentation from '@/views/documentation/documentation.vue';
import Favorite from '@/views/favorite/favorite.vue';
import Legenda from '@/views/legenda/legenda.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/recipe/:urlName',
      name: 'RecipeDetail',
      component: DetailPage,
      props: true,
    },
    {
      path: '/documentation',
      name: 'Documentation',
      component: Documentation,
      props: true,
    },
    {
      path: '/favorite',
      name: 'Favorite',
      component: Favorite,
      props: true,
    },
    {
      path: '/legenda',
      name: 'Legenda',
      component: Legenda,
      props: true,
    }
  ],
});

export default router;