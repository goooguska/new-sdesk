<script setup>
import ExitIcon from "@/components/Icons/ExitIcon.vue";
import {useAuthStore} from "@/stores/authStore.js";
import router from "@/router/index.js";

defineProps({
  user: {
    type: Object,
    default: () => ({})
  },
});

const auth = useAuthStore()

const logout = async () => {
  try {
    await auth.logout()

    await router.push('/login')
  } catch (error) {
    alert('Ошибка при выходе.')
  }
}

</script>

<template>
  <div class="account">
    <p class="account__login">
      {{user.login}}
    </p>
    <p class="account__role">
      {{user.role}}
    </p>
    <ExitIcon @click="logout" class="account__exit"/>
  </div>
</template>

<style scoped>
.account {
  display: flex;
  gap: 20px;
  align-items: center;
  font-size: 16px;
  font-weight: bold;
  color: var(--primary-color);
}

.account__exit {
  cursor: pointer;
}
</style>