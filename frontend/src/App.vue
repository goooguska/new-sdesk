<script setup>
import { useAuthStore } from '@/stores/authStore'
import BaseLoader from "@/components/BaseComponents/BaseLoader.vue";

const auth = useAuthStore()
</script>

<template>
  <div v-if="auth.state.isLoading">
    <BaseLoader/>
  </div>
  <RouterView class="view" v-else />
</template>

<style scoped>
.view {
  margin: 50px 0;
}
</style>