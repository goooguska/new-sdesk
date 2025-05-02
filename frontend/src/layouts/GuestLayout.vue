<script setup>

import MainLogo from "@/components/icons/MainLogo.vue";
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

      <div v-if="auth.errors?.general" >
        <ErrorLabel :error="auth.errors.general[0]"/>
      </div>

    </main>
  </div>
</template>

<style scoped>
.guest-layout {
  min-height: 80vh;
}
.logo {
  margin-bottom: 70px;
}
</style>