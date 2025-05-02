<script setup>
import { useAuthStore } from '@/stores/authStore'

const auth = useAuthStore()
</script>

<template>
  <div v-if="auth.isLoading" class="loading-screen">
    Загрузка...
  </div>
  <RouterView class="view" v-else />
</template>

<style scoped>
.view {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>