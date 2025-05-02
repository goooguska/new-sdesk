<script setup>
import HeaderTemplate from "@/templates/HeaderTemplate.vue";
import FooterTemplate from "@/templates/FooterTemplate.vue";
</script>

<template>
  <div class="auth-layout">
    <HeaderTemplate/>
    <main class="content">
      <slot></slot>
    </main>
    <FooterTemplate/>
  </div>
</template>

<style scoped>
.auth-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.content {
  flex: 1 0 auto;
}

</style>