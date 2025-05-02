<script setup>

import MainLogo from "@/components/Icons/MainLogo.vue";
import {computed} from "vue";
import {useUserStore} from "@/stores/userStore.js";
import AccountInfo from "@/components/Account/AccountInfo.vue";
import {useAuthStore} from "@/stores/authStore.js";

const navigationRoutes = [
  {
    path: '/',
    title: 'Обращения',
    isAdmin: true
  },
  {
    path: '/dashboard',
    title: 'Статистика',
    isAdmin: true
  },
  {
    path: '/info',
    title: 'Справка',
  },
  {
    path: '/',
    title: 'Ваши обращения',
    isAdmin: false
  },
  {
    path: '/create-ticket',
    title: 'Создать заявку',
    isAdmin: false
  },
  {
    path: '/info',
    title: 'Справка',
    isAdmin: null
  },
]

const userStore = useUserStore();
const auth = useAuthStore();

const actualRoutes = computed(() => {
  const isAdmin = userStore.checkUserIsAdmin();
  return navigationRoutes.filter(route =>
      route.isAdmin === null || route.isAdmin === isAdmin
  );
});
</script>

<template>
  <header class="header">
    <RouterLink to="/">
      <MainLogo/>
    </RouterLink>
    <nav class="nav">
      <ul class="nav__list">
        <li v-for="route in actualRoutes" :key="route.path" class="nav__item">
          <RouterLink :to="route.path" class="nav__link" active-class="active-link">
            {{ route.title }}
          </RouterLink>
        </li>
      </ul>
    </nav>
    <div class="account" v-if="auth.state.user !== null">
      <AccountInfo :user="auth.state.user"/>
    </div>
  </header>
</template>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 50px;
}

.nav__list {
  display: flex;
  gap: 100px;
}

.nav__link {
  color: var(--primary-color);
  font-weight: bold;
  font-size: 20px;

}

.active-link {
  border-bottom: 3px solid var(--primary-color);
}

</style>