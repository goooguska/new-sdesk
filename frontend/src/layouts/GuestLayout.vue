<script setup>

import MainLogo from "@/components/Icons/MainLogo.vue";
import ErrorLabel from "@/components/Errors/ErrorLabel.vue";
import {useAuthStore} from "@/stores/authStore.js";

const auth = useAuthStore();

</script>

<template>
  <div class="guest-layout">
    <div class="logo">
      <MainLogo/>
    </div>
    <main>
      <slot></slot>

      <div v-if="auth.state.errors?.general" >
        <ErrorLabel :error="auth.state.errors.general[0]"/>
      </div>

    </main>
  </div>
</template>

<style scoped>
.guest-layout {
  min-height: 80vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.logo {
  margin-bottom: 70px;
}
</style>