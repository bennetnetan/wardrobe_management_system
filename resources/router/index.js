import { createRouter, createWebHistory } from 'vue-router';
import ClothingList from './components/ClothingList.vue';
import CreateClothing from './components/CreateClothing.vue';

const routes = [
  { path: '/clothing', component: ClothingList, name: 'clothing-list' },
  { path: '/clothing/create', component: CreateClothing, name: 'create-clothing' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
