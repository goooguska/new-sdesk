<script setup>
import { useAuthStore } from '@/stores/authStore'

const auth = useAuthStore()
</script>

<template>
  <div v-if="auth.state.isLoading" class="loading-screen">
    Загрузка...
  </div>
  <RouterView class="view" v-else />
</template>

<style scoped>
.view {
  margin: 50px 0;
}
</style>